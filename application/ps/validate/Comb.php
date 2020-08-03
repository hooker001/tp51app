<?php

namespace app\ps\validate;

use think\Validate;

class Comb extends Validate
{
    protected $rule = [
        'code' => 'require|length:8',
        'name' => 'require|max:50',
        'work_id' => 'require|max:30',
        'project_na' => 'require|max:50',
        'lane_way' => 'require|max:30',
        'addr' => 'require|max:50',
        'data_origi' => 'require|max:50',
        'feature' => 'require|max:20',
        'style' => 'require|max:20',
        'subtype' => 'require|max:20',
        'sur_h' => 'require|float',
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
