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
        $canalMdl = new \app\ps\model\Canal();
        $arrCanal = $canalMdl->field('gid,name')->select()->toArray();
        $combMdl = new \app\ps\model\Comb();
        $arrComb = $combMdl->field('gid,name')->select()->toArray();
        $dpMdl = new \app\ps\model\Dirpoint();
        $arrDp = $dpMdl->field('gid,name')->select()->toArray();
        $pipeMdl = new \app\ps\model\Pipe();
        $arrPipe = $pipeMdl->field('gid,name')->select()->toArray();
        $spoutMdl = new \app\ps\model\Spout();
        $arrSpout = $spoutMdl->field('gid,river as name')->select()->toArray();
        $wellMdl = new \app\ps\model\Well();
        $arrWell = $wellMdl->field('gid,name')->select()->toArray();

        $data = [
            'canal' => ['type' => 1, 'result' => $arrCanal],
            'comb' => ['type' => 2, 'result' => $arrComb],
            'dir_point' => ['type' => 3, 'result' => $arrDp],
            'pipe' => ['type' => 4, 'result' => $arrPipe],
            'spout' => ['type' => 5, 'result' => $arrSpout],
            'well' => ['type' => 6, 'result' => $arrWell],
        ];
        return jsonSuc($data);
    }
}
