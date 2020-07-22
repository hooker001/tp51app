<?php

namespace app\ps\validate;

use think\Validate;

class Prepro extends Validate
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
        'szname' => 'require|max:50',
        'pre_scale' => 'require|max:10',
        'pre_state' => 'require|max:10',
        'addr' => 'require|max:50',
        'pre_method' => 'require|max:30',
        'pre_type' => 'require|max:30',
        'pre_water' => 'require|float',
        'drain_water' => 'require|float',
        'ph_en' => 'require|float',
        'ph_ex' => 'require|float',
        'bod_en' => 'require|float',
        'bod_ex' => 'require|float',
        'cod_en' => 'require|float',
        'cod_ex' => 'require|float',
        'ss_en' => 'require|float',
        'ss_ex' => 'require|float',
        'nh_en' => 'require|float',
        'nh_ex' => 'require|float',
        'tn_en' => 'require|float',
        'tn_ex' => 'require|float',
        'tp_en' => 'require|float',
        'tp_ex' => 'require|float',
        'repair_date' => 'require|date',
        'repair_company' => 'require|max:50',
        'data_origin' => 'require|max:50',
        'remark' => 'max:255',
    ];
}
