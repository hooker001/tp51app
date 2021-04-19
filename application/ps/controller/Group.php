<?php

namespace app\ps\controller;

use think\Controller;
use app\ps\model\Group as Mdl;

class Group extends Controller
{
    public function create()
    {
        $arrPost = $this->request->post();
        if (!$arrPost || !isset($arrPost['type']) || !in_array($arrPost['type'], [1, 2, 3])) {
            return jsonErr('缺失入参');
        }
        if (isset($arrPost['layers']) && is_array($arrPost['layers'])) {
            $arrPost['layers'] = json_encode($arrPost['layers']);
        }
        if (!isset($arrPost['name']) || empty($arrPost['name'])) {
            return jsonErr('名称不能为空');
        }
        $mdl = new Mdl();
        $group = $mdl->where('name', $arrPost['name'])->find();
        // is_object($group) && $group->toArray();
        if ($group) {
            return jsonErr('名称重复');
        }
        $mdl->save($arrPost);
        return jsonSuc(['id' => $mdl->gid]);
    }

    public function update()
    {
        $id = intval($this->request->get('id'));
        $group = Mdl::get($id);
        if (!$group) {
            return jsonErr('数据不存在');
        }
        $arrPost = $this->request->post();
        if (isset($arrPost['layers']) && is_array($arrPost['layers'])) {
            $arrPost['layers'] = json_encode($arrPost['layers']);
        }
        $group->save($arrPost);
        return jsonSuc([]);
    }

    public function delete()
    {
        $id = intval($this->request->get('id'));
        $group = Mdl::get($id);
        $group->delete();
        return jsonSuc();
    }

    public function info()
    {
        $id = intval($this->request->get('id'));
        $group = Mdl::get($id)->toArray();
        $group['layers'] = json_decode($group['layers'], true);
        return jsonSuc($group);
    }

    //图层组合数据
    public function all()
    {
        $type = intval($this->request->get('type'));
        if (!$type) {
            return jsonSuc();
        }
        $mdl = new Mdl();
        $arrGroup = $mdl->field('gid,name')->where('type', $type)->select();
        return jsonSuc($arrGroup);
    }

    //全部图层数据
    public function layers()
    {
//        $canalMdl = new \app\ps\model\Canal();
//        $arrCanal = $canalMdl->field('gid,name')->select()->toArray();
//        $combMdl = new \app\ps\model\Comb();
//        $arrComb = $combMdl->field('gid,name')->select()->toArray();
//        $dpMdl = new \app\ps\model\Dirpoint();
//        $arrDp = $dpMdl->field('gid,name')->select()->toArray();
//        $pipeMdl = new \app\ps\model\Pipe();
//        $arrPipe = $pipeMdl->field('gid,name')->select()->toArray();
//        $spoutMdl = new \app\ps\model\Spout();
//        $arrSpout = $spoutMdl->field('gid,river as name')->select()->toArray();
//        $wellMdl = new \app\ps\model\Well();
//        $arrWell = $wellMdl->field('gid,name')->select()->toArray();
//
//        $data = [
//            'canal' => ['type' => 1, 'result' => []],
//            'comb' => ['type' => 2, 'result' => []],
//            'dir_point' => ['type' => 3, 'result' => []],
//            'pipe' => ['type' => 4, 'result' => []],
//            'spout' => ['type' => 5, 'result' => []],
//            'well' => ['type' => 6, 'result' => []],
//        ];
        $type = intval($this->request->get('type'));
        $data = [];
        switch ($type) {
            case 1:
                $data = [
                    ['typeid' => 1, 'name' => '排水沟渠'],
                    ['typeid' => 2, 'name' => '雨水口'],
                    ['typeid' => 3, 'name' => '管线暗点'],
                    ['typeid' => 4, 'name' => '排水管道'],
                    ['typeid' => 5, 'name' => '排放口'],
                    ['typeid' => 6, 'name' => '窖井'],
                ];
                break;
            case 2:
                $data = [
                    ['typeid' => 7, 'name' => '排水沟渠雨水'],
                    ['typeid' => 8, 'name' => '排水管道污水'],
                    ['typeid' => 9, 'name' => '排水管道雨水'],
                    ['typeid' => 10, 'name' => '排水管道雨污合流'],
                ];
                break;
            case 3:
                $data = [
                    ['typeid' => 11, 'name' => '排水沟渠支管'],
                    ['typeid' => 12, 'name' => '排水沟渠支管以下'],
                    ['typeid' => 13, 'name' => '排水沟渠支干管'],
                    ['typeid' => 14, 'name' => '排水管道支管'],
                    ['typeid' => 15, 'name' => '排水管道支管以下'],
                    ['typeid' => 16, 'name' => '排水管道支干管'],
                    ['typeid' => 17, 'name' => '排水管道主干管'],
                    ['typeid' => 18, 'name' => '排水沟渠干管'],
                    ['typeid' => 19, 'name' => '排水沟渠主干管'],
                    ['typeid' => 20, 'name' => '排水管道干管'],
                ];
                break;
        }

        return jsonSuc($data);
    }
}
