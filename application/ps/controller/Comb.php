<?php

namespace app\ps\controller;

use think\Controller;
use app\ps\validate\Comb as Vd;
use app\ps\model\Comb as Mdl;
use think\Db;
use app\common\model\Field;
use think\Exception;

class Comb extends Controller
{
    protected $fcode = '060206';

    public function create()
    {
        $arrPost = $this->request->post();
        if (!$arrPost) {
            return jsonErr('缺失入参');
        }
//        $validate = new Vd();
//        if (!$validate->check($arrPost)) {
//            return jsonErr($validate->getError());
//        }
//        $usid = $this->fcode . '-' . $arrPost['code'] . '-';
        $geom = $arrPost['geom'] ?? '';
        unset($arrPost['geom']);
//        $arrPost['fcode'] = $this->fcode;
        $model = new Mdl();
        $model->save($arrPost);
        $id = $model->gid;
//        $strId = str_pad($id, 6, '0', STR_PAD_LEFT);
//        $usid .= $strId;
//        $model->save(['usid' => $usid, 'geom' => 'st_geomfromgeojson(' . $geom . ')'], ['gid' => $id]);
        $sql = "update ps_comb_zy set geom=st_geomfromgeojson('$geom') where gid=" . $id;
        Db::execute($sql);
        return jsonSuc(['id' => $id]);
    }

    public function delete()
    {
        $id = intval($this->request->get('id'));
        $pipe = Mdl::get($id);
        if (!$pipe) {
            return jsonErr('数据不存在');
        }
        $pipe->delete();
        return jsonSuc();
    }

    public function info()
    {
        $id = intval($this->request->get('id'));
        $info = Mdl::where('gid', $id)->field('*,st_asgeojson(geom) as geojson')->find();
        if (!$info) {
            return jsonErr('数据不存在');
        }
        return jsonSuc($info->toArray());
    }

    public function update()
    {
        $id = intval($this->request->get('id'));
        $info = Mdl::get($id);
        if (!$info) {
            return jsonErr('数据不存在');
        }
        $arrPost = $this->request->post();
        $data = $arrPost;
//        if (isset($arrPost['code']) && $arrPost['code']) {
//            $data['usid'] = $this->fcode . '-' . $arrPost['code'] . '-' . str_pad($id, 6, '0', STR_PAD_LEFT);
//            unset($data['code']);
//        }
        $geom = '';
        if (isset($arrPost['geom']) && $arrPost['geom']) {
            $geom = $arrPost['geom'];
            unset($data['geom']);
        }
        $mdl = new Mdl();
        $mdl->save($data, ['gid' => $id]);
        if ($geom) {
            $sql = "update ps_comb_zy set geom=st_geomfromgeojson('$geom') where gid=" . $id;
            Db::execute($sql);
        }
        return jsonSuc();
    }

    /**
     * 获取全部字段
     */
    public function allFields()
    {
        $model = new Mdl();
//        $fields = $model->getTableFields();
        // 获取原生数据长度
        $tableName = $model->getTable();
        $systemField = 'column_name,data_type,character_maximum_length,numeric_precision,udt_name';
        $sql = "select {$systemField} from information_schema.columns where table_schema='public' and table_name='{$tableName}'";
        $fields = Db::query($sql);
        // 获取编辑后的数据长度
        $localFields = Field::where('field_table', $tableName)->select()->toArray();
        $localFields = $localFields ? array_column($localFields, null, 'field_name') : [];
        $arrayData = [];
        $arrayType = ['int2' => 'I', 'int4' => 'I', 'float8' => 'D', 'date' => 'T', 'varchar' => 'C', 'numeric' => 'D'];
        $arrayLen = ['int2' => '2', 'int4' => '4', 'float8' => '38,8', 'numeric' => '38,8'];
        foreach ($fields as $field) {
            if (in_array($field['column_name'], ['gid', 'geom'])) {
                continue;
            }
            $fieldType = $localFields[$field['column_name']]['field_type'] ?? ($arrayType[$field['udt_name']] ?? '');
            $fieldLen = $localFields[$field['column_name']]['field_length'] ?? ($field['character_maximum_length'] ?? ($arrayLen[$field['udt_name']] ?? ''));
            $arrayData[] = [
                'field_name' => $field['column_name'],
                'field_type' => $fieldType,
                'field_length' => $fieldLen,
                'field_title' => $localFields[$field['column_name']]['field_title'] ?? '',
                'field_desc' => $localFields[$field['column_name']]['field_desc'] ?? '',
            ];
        }

        return jsonSuc($arrayData);
    }

    /**
     * 添加字段
     */
    public function addField()
    {
        $arrPost = $this->request->post();
        if (!$arrPost) {
            return jsonErr('缺失入参');
        }
        $arrAllowFields = ['field_name', 'field_type', 'field_length', 'field_title', 'field_desc'];
        $arrForm = array_intersect_key($arrPost, array_flip($arrAllowFields));
        $arrForm = array_filter($arrForm);
        if (count($arrAllowFields) != count($arrForm)) {
            return jsonErr('缺失入参');
        }

        // 获取字段类型
        $fieldType = getDataType($arrForm['field_type'], $arrForm['field_length']);
        if (!$fieldType) {
            return jsonErr('数据类型错误');
        }
        $model = new Mdl();
        $tableName = $model->getTable();
        if ($fieldType == 'varchar') {
            $sql = "ALTER TABLE public.{$tableName} ADD COLUMN {$arrForm['field_name']} {$fieldType}({$arrForm['field_length']})";
        } else {
            $sql = "ALTER TABLE public.{$tableName} ADD COLUMN {$arrForm['field_name']} {$fieldType}";
        }
        $extModel = new Field();
        $arrForm['field_table'] = $tableName;
        Db::startTrans();
        try {
            Db::execute($sql);
            Db::table($extModel->getTable())->insert($arrForm);
            Db::commit();

            return jsonSuc();
        } catch (Exception $e) {
            Db::rollback();

            return jsonErr($e->getMessage());
        }
    }

    /**
     * 修改字段
     */
    public function updateField()
    {
        $arrPost = $this->request->post();
        if (!$arrPost) {
            return jsonErr('缺失入参');
        }
        $arrAllowFields = ['field_name', 'field_type', 'field_length', 'field_title', 'field_desc'];
        $arrForm = array_intersect_key($arrPost, array_flip($arrAllowFields));
        $arrForm = array_filter($arrForm);
        if (count($arrAllowFields) != count($arrForm)) {
            return jsonErr('缺失入参');
        }
        // 获取修改后数据类型
        $fieldType = getDataType($arrForm['field_type'], $arrForm['field_length']);
        if (!$fieldType) {
            return jsonErr('数据类型错误');
        }
        $model = new Mdl();
        $tableName = $model->getTable();
        $fieldName = $arrForm['field_name'];
        $oriName = '';
        $arrFieldName = explode(':', $fieldName);
        $isRename = false;
        if (count($arrFieldName)==2) {
            $oriName = $arrFieldName[0];
            $fieldName = $arrFieldName[1];
            if ($oriName != $fieldName) {
                $isRename = true;
            }
        }
        if ($isRename) {
            $renameSql = "ALTER TABLE public.{$tableName} RENAME COLUMN {$oriName} TO {$fieldName}";
        }
        if ($fieldType == 'varchar') {
            $fieldType = $fieldType."({$arrForm['field_length']})";
        }

        $sql = "ALTER TABLE public.{$tableName} ALTER COLUMN {$fieldName} TYPE {$fieldType} USING {$fieldName}::{$fieldType}";

        $extModel = new Field();
        $extTable = $extModel->getTable();
        $colName = $isRename ? $oriName : $fieldName;
        $ext = $extModel->where(['field_table' => $tableName, 'field_name' => $colName])->find();
        if ($ext) {
            if ($isRename) {
                $arrForm['field_name'] = $fieldName;
            } else {
                unset($arrForm['field_name']);
            }
        } else {
            $arrForm['field_name'] = $fieldName;
            $arrForm['field_table'] = $tableName;
        }
        Db::startTrans();
        try {
            if (isset($renameSql)) {
                Db::execute($renameSql);
            }
            Db::execute($sql);
            if ($ext) {
                Db::name($extTable)->where(['field_table' => $tableName, 'field_name' => $colName])->update($arrForm);
            } else {
                Db::name($extTable)->insert($arrForm);
            }

            Db::commit();

            return jsonSuc();
        } catch (Exception $e) {
            Db::rollback();

            return jsonErr('当前类型不支持相互转换！');
        }
    }

    /**
     * 删除字段
     */
    public function deleteField()
    {
        $arrPost = $this->request->post();
        if (!$arrPost) {
            return jsonErr('缺失入参');
        }
        if (!isset($arrPost['field_name']) || !$arrPost['field_name']) {
            return jsonErr('缺失参数');
        }
        $model = new Mdl();
        $tableName = $model->getTable();
        $sql = "ALTER TABLE public.{$tableName} DROP COLUMN {$arrPost['field_name']}";
        $extModel = new Field();
        $ext = $extModel->where(['field_table' => $tableName, 'field_name' => $arrPost['field_name']])->find();

        Db::startTrans();
        try {
            Db::execute($sql);
            if ($ext) {
                Db::name($extModel->getTable())->where([
                    'field_table' => $tableName, 'field_name' => $arrPost['field_name'],
                ])->delete();
            }
            Db::commit();

            return jsonSuc();

        } catch (Exception $e) {
            Db::rollback();

            return jsonErr('操作失败');
        }
    }
}
