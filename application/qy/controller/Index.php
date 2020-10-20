<?php
namespace app\qy\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    //图层组合查询
    public function searchType()
    {
        $arrParam = $this->request->get();
        $type = [];
        if (isset($arrParam['type']) && is_string($arrParam['type'])) {
            $type = explode(',', $arrParam['type']);
        }
        unset($arrParam['type']);
        $arrData = [];
        if (in_array(1, $type)) {
            $canalMdl = new \app\qy\model\Canal();
            $arrCanal = $canalMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
            $arrData = array_merge($arrData, $arrCanal);
        }
//        if (in_array(2, $type)) {
//            $combMdl = new \app\ps\model\Comb();
//            $arrComb = $combMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrComb);
//        }
//        if (in_array(3, $type)) {
//            $dirpointMdl = new \app\ps\model\Dirpoint();
//            $arrDp = $dirpointMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrDp);
//        }
        if (in_array(4, $type)) {
            $pipeMdl = new \app\qy\model\Pipe();
            $arrPipe = $pipeMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
            $arrData = array_merge($arrData, $arrPipe);
        }
//        if (in_array(5, $type)) {
//            $spoutMdl = new \app\ps\model\Spout();
//            $arrSpout = $spoutMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrSpout);
//        }
//        if (in_array(6, $type)) {
//            $wellMdl = new \app\ps\model\Well();
//            $arrWell = $wellMdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrWell);
//        }
//        if (in_array(7, $type)) {
//            $mdl = new Canalzyys();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(8, $type)) {
//            $mdl = new Pipezyws();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(9, $type)) {
//            $mdl = new Pipezyys();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(10, $type)) {
//            $mdl = new Pipezyywhl();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(11, $type)) {
//            $mdl = new Canalzyzg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(12, $type)) {
//            $mdl = new Canalzyzgyx();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(13, $type)) {
//            $mdl = new Canalzyzhigg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(14, $type)) {
//            $mdl = new Pipezyzg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(15, $type)) {
//            $mdl = new Pipezyzgyx();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(16, $type)) {
//            $mdl = new Pipezyzhigg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(17, $type)) {
//            $mdl = new Pipezyzhugg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(18, $type)) {
//            $mdl = new Canalzygg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(19, $type)) {
//            $mdl = new Canalzyzhugg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
//        if (in_array(20, $type)) {
//            $mdl = new Pipezygg();
//            $arrRe = $mdl->field('gid, layers, st_asgeojson(geom) as geom')->select()->toArray();
//            $arrData = array_merge($arrData, $arrRe);
//        }
        return jsonSuc($arrData);
    }

    
}
