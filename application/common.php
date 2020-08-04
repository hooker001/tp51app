<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function jsonSuc($data = [], $status = 1)
{
    return json(['status' => $status, 'data' => $data, 'msg' => '']);
}

function jsonErr($msg = '', $status = 0)
{
    return json(['status' => $status, 'data' => [], 'msg' => $msg]);
}

/**
 * 获取毫秒时间戳
 * @return float
 */
function getMillisecond()
{
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}