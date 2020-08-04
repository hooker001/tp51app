<?php

namespace app\ps\model;

use think\Model;

class Dirpoint extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_dir_point_zy';

    public function getAll($arrCond)
    {
        $allowField = ['district', 'lane_way', 'sort'];
        $arrParam = array_intersect_key($arrCond, array_flip($allowField));
        if (!$arrParam || count($arrCond) > count($arrParam)) {
            return [];
        }
        $model = new self();
        $model = $model->field('gid, st_asgeojson(geom) as geom');
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', 'like', '%' . $arrParam['district'] . '%');
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', 'like', '%' . $arrParam['lane_way'] . '%');
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', 'like', '%' . $arrParam['sort'] . '%');
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }
}
