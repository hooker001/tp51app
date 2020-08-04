<?php

namespace app\ps\model;

use think\Model;

class Comb extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_comb_zy';

    public function getAll($arrCond)
    {
        $allowField = ['district', 'subtype', 'lane_way'];
        $arrParam = array_intersect_key($arrCond, array_flip($allowField));
        if (!$arrParam || count($arrCond) > count($arrParam)) {
            return [];
        }
        $model = new self();
        $model = $model->field('gid, st_asgeojson(geom) as geom');
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', 'like', '%' . $arrParam['district'] . '%');
        }
        if (isset($arrParam['subtype']) && $arrParam['subtype']) {
            $model = $model->where('subtype', 'like', '%' . $arrParam['subtype'] . '%');
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', 'like', '%' . $arrParam['lane_way'] . '%');
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }
}
