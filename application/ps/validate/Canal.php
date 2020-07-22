<?php
namespace app\ps\validate;

use think\Validate;

class Canal extends Validate
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
        'struct' => 'require|max:20',
        'bs_shape' => 'require|max:20',
        'subtype' => 'require|max:20',
        'is_press' => 'require',
        'start_usid' => 'require|max:20',
        'end_usid' => 'require|max:20',
        'beg_h' => 'require|float',
        'begcen_deep' => 'require|float',
        'width' => 'require|float',
        'height' => 'require|float',
        'end_h' => 'require|float',
        'endcen_deep' => 'require|float',
        'length' => 'require|float',
        'i' => 'require|float',
        'repair_date' => 'require|date',
        'repair_company' => 'require|max:50',
        'data_origin' => 'require|max:50',
        'remark' => 'max:255',
    ];
}
