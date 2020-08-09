<?php

namespace app\ps\model;

use think\Model;

class Pipe extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_pipe_zy';

    public function getAll($arrCond)
    {
        $arrParam = $this->checkCond($arrCond);
        if (!$arrParam) {
            return [];
        }
        $model = new self();
        $model = $model->field('gid, st_asgeojson(geom) as geom');
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', 'in', $arrParam['district']);
        }
//        if (isset($arrParam['subtype']) && $arrParam['subtype']) {
//            $model = $model->where('subtype', 'like', '%' . $arrParam['subtype'] . '%');
//        }
        if (isset($arrParam['material']) && $arrParam['material']) {
            $model = $model->where('material', 'in', $arrParam['material']);
        }
        if (isset($arrParam['d_s']) && $arrParam['d_s']) {
            $model = $model->where('d_s', 'in', $arrParam['d_s']);
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', 'in', $arrParam['lane_way']);
        }
        if (isset($arrParam['grade']) && $arrParam['grade']) {
            $model = $model->where('grade', 'in', $arrParam['grade']);
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', 'in', $arrParam['sort']);
        }
        if (isset($arrParam['srv']) && $arrParam['srv']) {
            $model = $model->where('srv', 'like', '%' . $arrParam['srv'] . '%');
        }
        if (isset($arrParam['geom']) && $arrParam['geom']) {
            $model = $model->where("st_contains(st_geomfromgeojson('".$arrParam['geom']."'),geom)");
        }
        if (isset($arrParam['option']) && $arrParam['option']) {
            foreach ($arrParam['option'] as $item) {
                if (!isset($item['f']) || !$item['f'] || !isset($item['o']) || !$item['o'] || !isset($item['v']) || !$item['v']) {
                    continue;
                }
                $val = $item['o'] == 'like' ? '%' . $item['v'] . '%' : $item['v'];
                if (isset($item['r']) && $item['r'] == 'or') {
                    $model = $model->whereOr($item['f'], $item['o'], $val);
                } else {
                    $model = $model->where($item['f'], $item['o'], $val);
                }
            }
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }

    public function lists($arrParam)
    {
        $model = new self();
        if (isset($arrParam['name']) && $arrParam['name']) {
            $model = $model->where('name', $arrParam['name']);
        }
        if (isset($arrParam['lng']) && $arrParam['lng']) {
            $model = $model->where('lng', $arrParam['lng']);
        }
        if (isset($arrParam['lat']) && $arrParam['lat']) {
            $model = $model->where('lat', $arrParam['lat']);
        }
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', $arrParam['district']);
        }
        if (isset($arrParam['river']) && $arrParam['river']) {
            $model = $model->where('river', $arrParam['river']);
        }
        if (isset($arrParam['level']) && $arrParam['level']) {
            $model = $model->where('level', $arrParam['level']);
        }
        if (isset($arrParam['sewagesystem_id']) && $arrParam['sewagesystem_id']) {
            $model = $model->where('sewagesystem_id', $arrParam['sewagesystem_id']);
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', $arrParam['lane_way']);
        }
        if (isset($arrParam['grade']) && $arrParam['grade']) {
            $model = $model->where('grade', $arrParam['grade']);
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', $arrParam['sort']);
        }
        if (isset($arrParam['pipetype']) && $arrParam['pipetype']) {
            $model = $model->where('pipetype', $arrParam['pipetype']);
        }
        if (isset($arrParam['material']) && $arrParam['material']) {
            $model = $model->where('material', $arrParam['material']);
        }
        if (isset($arrParam['d_s']) && $arrParam['d_s']) {
            $model = $model->where('d_s', $arrParam['d_s']);
        }
        return $model->order('id', 'desc')->select()->toArray();
    }

    //如果存在不属于当前模型的字段，则验证失败
    protected function checkCond($arrCond)
    {
        $fields = $this->getTableFields();
        $unkownField = false;
        foreach ($arrCond as $f => $v) {
            if ($f == 'option') {
                foreach ($v as $item) {
                    if (!in_array($item['f'], $fields)) {
                        $unkownField = true;
                        break 2;
                    }
                }
            } else {
                if (!in_array($f, $fields)) {
                    $unkownField = true;
                    break;
                }
            }
        }
        return $unkownField ? false : $arrCond;
    }
}
