<?php

namespace app\ps\validate;

use think\Validate;

class Spout extends Validate
{
    protected $rule = [
        'fcode' => 'require',
        'usid' => 'require',
        'river' => 'require|max:50',
        'work_id' => 'require|max:30',
        'project_na' => 'require|max:50',
        'lane_way' => 'require|max:30',
        'addr' => 'require|max:50',
        'data_origi' => 'require|max:50',
        'top_h' => 'require|float',
        'bottom_h' => 'require|float',
        'sur_h' => 'require|float',
        'sort' => 'require|max:30',
        'flow_media' => 'require|max:10',
        'flux' => 'require|float',
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
        'srv'=>'require',
    ];
}
