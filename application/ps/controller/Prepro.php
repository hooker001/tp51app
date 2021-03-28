<?php

namespace app\ps\controller;

use think\Controller;
use app\ps\validate\Prepro as Vd;
use app\ps\model\Prepro as Mdl;

class Prepro extends Controller
{
    /**
     * @var string 当前控制器未使用
     */
    protected $fcode = '060305';

    public function create()
    {
        $arrPost = $this->request->post();
        $validate = new Vd();
        if (!$validate->check($arrPost)) {
            return jsonErr($validate->getError());
        }
        $usid = $this->fcode . '-' . $arrPost['code'] . '-';
        unset($arrPost['code']);
        $arrPost['fcode'] = $this->fcode;
        $model = new Mdl();
        $model->save($arrPost);
        $id = $model->id;
        $strId = str_pad($id, 6, '0', STR_PAD_LEFT);
        $usid .= $strId;
        $model->usid = $usid;
        $model->save();
        return jsonSuc();
    }

    public function delete()
    {
        $id = intval($this->request->get('id'));
        $pipe = Mdl::get($id);
        if (!$pipe) {
            return jsonErr('数据不存在');
        }
        return jsonSuc($pipe->toArray());
    }

    public function info()
    {
        $id = intval($this->request->get('id'));
        $usid = $this->request->get('usid');
        if (!$id && !$usid) {
            return jsonErr('缺少设备标识');
        }
        if ($id) {
            $pipe = Mdl::get($id);
        } else {
            $pipe = Mdl::where('usid', $usid)->find();
        }
        if (!$pipe) {
            return jsonErr('数据不存在');
        }
        return jsonSuc($pipe->toArray());
    }
}
