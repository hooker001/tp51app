<?php

namespace app\ps\validate;

use think\Validate;

class Well extends Validate
{
    protected $rule = [
        'code' => 'require|length:8',
        'name' => 'require|max:50',
        'work_id' => 'require|max:30',
        'project_na' => 'require|max:50',
        'lane_way' => 'require|max:30',
        'addr' => 'require|max:50',
        'data_origi' => 'require|max:50',
        'subtype' => 'require|max:20',
        'cover_type' => 'require|max:20',
        'cover_mate' => 'require|max:20',
        'cover_size' => 'require|float',
        'well_statu' => 'max:255',
        'sur_h' => 'require|float',
        'bottom_h' => 'require|float',
        'material' => 'require|max:20',
        'sort' => 'require|max:20',
        'bt_h' => 'require|float',
        'ownerdept' => 'require|max:30',
        'managedept' => 'require|max:30',
        'state' => 'require|max:4',
        'district' => 'require|max:20',
        'finish_dat' => 'require|date',
        'date_' => 'require|date',
        'repair_dat' => 'require|date',
        'repair_com' => 'require|max:50',
        'data_versi' => 'require|max:30',
        'remark' => 'max:255',
        'task_id' => 'require',
        'updatedate' => 'require|date',
        'gengxcs' => 'require',
        'layers' => 'require|max:150',
        'checkstate' => 'require|max:16',
        'parentid' => 'require',
        'tc' => 'require',
        'geom' => 'require',
    ];
}
