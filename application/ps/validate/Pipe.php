<?php

namespace app\ps\validate;

use think\Validate;

class Pipe extends Validate
{
    protected $rule = [
        'fcode' => 'require',
        'usid' => 'require',
        'name' => 'require|max:50',
        'work_id' => 'require|max:30',
        'project_na' => 'require|max:50',
        'lane_way' => 'require|max:30',
        'addr' => 'require|max:50',
        'data_origi' => 'require|max:50',
        'start_usid' => 'require|max:20',
        'end_usid' => 'require|max:20',
        'grade' => 'require|max:20',
        'sort' => 'require|max:20',
        'subtype' => 'require|max:20',
        'material' => 'require|max:20',
        'length' => 'require|float',
        'beg_h' => 'require|float',
        'end_h' => 'require|float',
        'begcen_dee' => 'require|float',
        'endcen_dee' => 'require|float',
        'd_s' => 'require|integer',
        'style' => 'require|max:10',
        'i' => 'require|float',
        'is_press' => 'require',
        'ownerdept' => 'require|max:30',
        'managedept' => 'require|max:30',
        'state' => 'require|max:4',
        'district' => 'require|max:20',
        'takeover_d' => 'require|date',
        'date_' => 'require|date',
        'repair_dat' => 'require|date',
        'repair_com' => 'require|max:50',
        'data_versi' => 'require|max:50',
        'remark' => 'max:255',
        'task_id' => 'require',
        'updatedate' => 'require|date',
        'gengxcs' => 'require',
        'layers' => 'require|max:150',
        'checkstate' => 'require|max:16',
        'parentid' => 'require',
        'l' => 'require',
        'tc' => 'require',
        'geom' => 'require',
        'srv'=>'require',
    ];

    protected $message = [
//        'name.require' => '名称必须',
//        'name.max' => '名称最多不能超过5个字符',
    ];
}
