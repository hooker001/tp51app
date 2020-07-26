<?php

namespace app\ps\validate;

use think\Validate;

class Pipe extends Validate
{
    protected $rule = [
        'code' => 'require|length:8',
        'sewagesystem_id' => 'require|max:20',
        'rainesystem_id' => 'require|max:20',
        'district' => 'require|max:20',
        'project_name' => 'require|max:50',
        'ownerdept' => 'require|max:30',
        'managedept' => 'require|max:30',
        'state' => 'require|max:4',
        'finish_date' => 'require|date',
        'name' => 'require|max:50',
        'work_id' => 'require|max:30',
        'lane_way' => 'require|max:30',
        'addr' => 'require|max:50',
        'grade' => 'require|max:20',
        'sort' => 'require|max:20',
        'pipetype' => 'require|max:20',
        'subtype' => 'require|max:20',
        'material' => 'require|max:20',
        'is_press' => 'require',
        'start_usid' => 'require|max:20',
        'end_usid' => 'require|max:20',
        'beg_h' => 'require|float',
        'begcen_deep' => 'require|float',
        'end_h' => 'require|float',
        'endcen_deep' => 'require|float',
        'd_s' => 'require|integer',
        'length' => 'require|float',
        'style' => 'require|max:10',
        'i' => 'require|float',
        'repair_date' => 'require|date',
        'repair_company' => 'require|max:50',
        'data_origin' => 'require|max:50',
        'river' => 'require|max:10',
        'serv' => 'require|max:50',
        'lng' => 'require|float',
        'lat' => 'require|float',
        'remark' => 'max:255',
    ];

    protected $message = [
//        'name.require' => '名称必须',
//        'name.max' => '名称最多不能超过5个字符',
    ];
}
