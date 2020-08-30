<?php

namespace app\ps\controller;

use think\Controller;
use app\ps\model\Group as Mdl;

class Group extends Controller
{
    public function create()
    {
        $arrPost = $this->request->post();
        if (!$arrPost) {
            return jsonErr('缺失入参');
        }
        $mdl = new Mdl();
        $mdl->save($arrPost);
        return jsonSuc(['id' => $mdl->gid]);
    }

    public function update()
    {
        $id = intval($this->request->get('id'));
        $group = Mdl::get($id);
        if (!$group) {
            jsonErr('数据不存在');
        }
        $arrPost = $this->request->post();
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
        $group = Mdl::get($id);
        return jsonSuc($group);
    }

    //图层组合数据
    public function all()
    {
        $mdl = new Mdl();
        $arrGroup = $mdl->field('gid,name')->select();
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
                    ['type' => 1, 'name' => '排水沟渠'],
                    ['type' => 2, 'name' => '雨水口'],
                    ['type' => 3, 'name' => '管线暗点'],
                    ['type' => 4, 'name' => '排水管道'],
                    ['type' => 5, 'name' => '排放口'],
                    ['type' => 6, 'name' => '窖井'],
                ];
                break;
            case 2:
                $data = [
                    ['type' => 7, 'name' => '排水沟渠雨水'],
                    ['type' => 8, 'name' => '排水管道污水'],
                    ['type' => 9, 'name' => '排水管道雨水'],
                    ['type' => 10, 'name' => '排水管道雨污合流'],
                ];
                break;
            case 3:
                $data = [
                    ['type' => 11, 'name' => '排水沟渠支管'],
                    ['type' => 12, 'name' => '排水沟渠支管以下'],
                    ['type' => 13, 'name' => '排水沟渠支干管'],
                    ['type' => 14, 'name' => '排水管道支管'],
                    ['type' => 15, 'name' => '排水管道支管以下'],
                    ['type' => 16, 'name' => '排水管道支干管'],
                    ['type' => 17, 'name' => '排水管道主干管'],
                ];
                break;
        }

        return jsonSuc($data);
    }
}
