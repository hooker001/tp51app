<?php

namespace app\ps\model;

use think\Model;

class Well extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_well_zy';

    public function getAll($arrCond)
    {
        $allowField = ['district', 'subtype', 'material', 'lane_way', 'sort', 'srv'];
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
        if (isset($arrParam['material']) && $arrParam['material']) {
            $model = $model->where('material', 'like', '%' . $arrParam['material'] . '%');
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', 'like', '%' . $arrParam['lane_way'] . '%');
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', 'like', '%' . $arrParam['sort'] . '%');
        }
        if (isset($arrParam['srv']) && $arrParam['srv']) {
            $model = $model->where('srv', 'like', '%' . $arrParam['srv'] . '%');
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }
}
