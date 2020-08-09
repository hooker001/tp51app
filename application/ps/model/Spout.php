<?php

namespace app\ps\model;

use think\Model;

class Spout extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_spout_zy';

    public function getAll($arrCond)
    {
        $allowField = ['district', 'river', 'lane_way', 'sort', 'srv', 'geom', 'type'];
        $arrParam = array_intersect_key($arrCond, array_flip($allowField));
        if (!$arrParam || count($arrCond) > count($arrParam)) {
            return [];
        }
        if (isset($arrParam['type']) && !in_array(5, $arrParam['type'])) {
            return [];
        }
        $model = new self();
        $model = $model->field('gid, st_asgeojson(geom) as geom');
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', 'like', '%' . $arrParam['district'] . '%');
        }
        if (isset($arrParam['river']) && $arrParam['river']) {
            $model = $model->where('river', 'like', '%' . $arrParam['river'] . '%');
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
        if (isset($arrParam['geom']) && $arrParam['geom']) {
            $model = $model->where("st_contains(st_geomfromgeojson('".$arrParam['geom']."'),geom)");
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }
}
