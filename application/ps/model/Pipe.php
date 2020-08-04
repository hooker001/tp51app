<?php

namespace app\ps\model;

use think\Model;

class Pipe extends Model
{
    protected $pk = 'gid';

    protected $table = 'ps_pipe_zy';

    public function getAll($arrCond)
    {
        $allowField = ['district', 'subtype', 'material', 'd_s', 'lane_way', 'grade', 'sort'];
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
        if (isset($arrParam['d_s']) && $arrParam['d_s']) {
            $model = $model->where('d_s', $arrParam['d_s']);
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', 'like', '%' . $arrParam['lane_way'] . '%');
        }
        if (isset($arrParam['grade']) && $arrParam['grade']) {
            $model = $model->where('grade', 'like', '%' . $arrParam['grade'] . '%');
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', 'like', '%' . $arrParam['sort'] . '%');
        }
        return $model->order('gid', 'desc')->select()->toArray();
    }

    public function lists($arrParam)
    {
        $model = new self();
        if (isset($arrParam['name']) && $arrParam['name']) {
            $model = $model->where('name', $arrParam['name']);
        }
        if (isset($arrParam['lng']) && $arrParam['lng']) {
            $model = $model->where('lng', $arrParam['lng']);
        }
        if (isset($arrParam['lat']) && $arrParam['lat']) {
            $model = $model->where('lat', $arrParam['lat']);
        }
        if (isset($arrParam['district']) && $arrParam['district']) {
            $model = $model->where('district', $arrParam['district']);
        }
        if (isset($arrParam['river']) && $arrParam['river']) {
            $model = $model->where('river', $arrParam['river']);
        }
        if (isset($arrParam['level']) && $arrParam['level']) {
            $model = $model->where('level', $arrParam['level']);
        }
        if (isset($arrParam['sewagesystem_id']) && $arrParam['sewagesystem_id']) {
            $model = $model->where('sewagesystem_id', $arrParam['sewagesystem_id']);
        }
        if (isset($arrParam['lane_way']) && $arrParam['lane_way']) {
            $model = $model->where('lane_way', $arrParam['lane_way']);
        }
        if (isset($arrParam['grade']) && $arrParam['grade']) {
            $model = $model->where('grade', $arrParam['grade']);
        }
        if (isset($arrParam['sort']) && $arrParam['sort']) {
            $model = $model->where('sort', $arrParam['sort']);
        }
        if (isset($arrParam['pipetype']) && $arrParam['pipetype']) {
            $model = $model->where('pipetype', $arrParam['pipetype']);
        }
        if (isset($arrParam['material']) && $arrParam['material']) {
            $model = $model->where('material', $arrParam['material']);
        }
        if (isset($arrParam['d_s']) && $arrParam['d_s']) {
            $model = $model->where('d_s', $arrParam['d_s']);
        }
        return $model->order('id', 'desc')->select()->toArray();
    }
}
