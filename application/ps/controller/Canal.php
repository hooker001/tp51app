<?php

namespace app\ps\controller;

use think\Controller;
use app\ps\validate\Canal as Vd;
use app\ps\model\Canal as Mdl;
use think\Db;

class Canal extends Controller
{
    protected $fcode = '060102';

    public function create()
    {
        $arrPost = $this->request->post();
        $validate = new Vd();
        if (!$validate->check($arrPost)) {
            return jsonErr($validate->getError());
        }
        $usid = $this->fcode . '-' . $arrPost['code'] . '-';
        $geom = $arrPost['geom'];
        unset($arrPost['code'], $arrPost['geom']);
        $arrPost['fcode'] = $this->fcode;
        $model = new Mdl();
        $model->save($arrPost);
        $id = $model->gid;
        $strId = str_pad($id, 6, '0', STR_PAD_LEFT);
        $usid .= $strId;
        $sql = "update ps_canal_zy set geom=st_geomfromgeojson('$geom'),usid='$usid' where gid=" . $id;
        Db::execute($sql);
        return jsonSuc();
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
}
