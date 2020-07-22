<?php

namespace app\ps\validate;

use think\Validate;

class Well extends Validate
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
        'sort' => 'require|max:20',
        'subtype' => 'require|max:20',
        'cover_type' => 'require|max:20',
        'cover_material' => 'require|max:20',
        'cover_size' => 'require|float',
        'material' => 'require|max:20',
        'sur_h' => 'require|float',
        'chamber_roof' => 'require|float',
        'bottom_h' => 'require|float',
        'bt_h' => 'require|float',
        'chamber_area' => 'require|float',
        'well_status' => 'max:255',
        'x' => 'require|float',
        'y' => 'require|float',
        'repair_date' => 'require|date',
        'repair_company' => 'require|max:50',
        'data_origin' => 'require|max:50',
        'remark' => 'max:255',
    ];
}
