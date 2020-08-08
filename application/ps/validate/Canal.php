<?php

namespace app\ps\validate;

use think\Validate;

class Canal extends Validate
{
    protected $rule = [
        'fcode' => 'require',
        'usid' => 'require',
        'name' => 'require|max:50',
        'work_id' => 'require|max:30',
        'project_na' => 'require|max:50',
        'addr' => 'require|max:50',
        'data_origi' => 'require|max:50',
        'start_usid' => 'require|max:20',
        'end_usid' => 'require|max:20',
        'grade' => 'require|max:20',
        'sort' => 'require|max:20',
        'subtype' => 'require|max:20',
        'length' => 'require|float',
        'width' => 'require|float',
        'height' => 'require|float',
        'i' => 'require|float',
        'beg_h' => 'require|float',
        'end_h' => 'require|float',
        'begin_deep' => 'require|float',
        'end_deep' => 'require|float',
        'struct' => 'require|max:20',
        'bs_shape' => 'require|max:20',
        'is_press' => 'require',
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
        'gengxcs' => 'require|float',
        'layers' => 'require|max:150',
        'lane_way' => 'require|max:30',
        'checkstate' => 'require|max:16',
        'parentid' => 'require',
        'l' => 'require',
        'tc' => 'require',
        'geom' => 'require',
        'srv'=>'require',
    ];
}
