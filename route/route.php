<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');

Route::group('ps', function () {
    Route::get('home', 'ps/index/home');
    Route::get('info', 'ps/index/info');
    Route::get('search', 'ps/index/search');
    Route::get('pdf', 'ps/index/pdf');
    Route::get('material', 'ps/index/material');
    Route::get('pipeds', 'ps/index/pipeds');
    Route::get('grade', 'ps/index/grade');
    Route::get('sort', 'ps/index/sort');
    Route::get('district', 'ps/index/district');
    Route::get('river', 'ps/index/river');
    Route::get('laneway', 'ps/index/laneway');
    Route::get('field', 'ps/index/field');

    Route::post('pipe/create', 'ps/pipe/create');
    Route::post('pipe/delete', 'ps/pipe/delete');
    Route::get('pipe/info', 'ps/pipe/info');
//    Route::get('pipe/lists', 'ps/pipe/lists');
    Route::post('canal/create', 'ps/canal/create');
    Route::post('canal/delete', 'ps/canal/delete');
    Route::get('canal/info', 'ps/canal/info');
    Route::post('dirpoint/create', 'ps/dirpoint/create');
    Route::post('dirpoint/delete', 'ps/dirpoint/delete');
    Route::get('dirpoint/info', 'ps/dirpoint/info');
//    Route::post('alterdia/create', 'ps/alterdia/create');
//    Route::post('alterdia/delete', 'ps/alterdia/delete');
    Route::post('spout/create', 'ps/spout/create');
    Route::post('spout/delete', 'ps/spout/delete');
    Route::get('spout/info', 'ps/spout/info');
    Route::post('well/create', 'ps/well/create');
    Route::post('well/delete', 'ps/well/delete');
    Route::get('well/info', 'ps/well/info');
    Route::post('comb/create', 'ps/comb/create');
    Route::post('comb/delete', 'ps/comb/delete');
    Route::get('comb/info', 'ps/comb/info');
//    Route::post('prepro/create', 'ps/prepro/create');
//    Route::post('prepro/delete', 'ps/prepro/delete');
//    Route::get('prepro/info', 'ps/prepro/info');
    Route::post('canal/update', 'ps/canal/update');
    Route::post('comb/update', 'ps/comb/update');
    Route::post('dirpoint/update', 'ps/dirpoint/update');
    Route::post('pipe/update', 'ps/pipe/update');
    Route::post('spout/update', 'ps/spout/update');
    Route::post('well/update', 'ps/well/update');
    //图层组合
    Route::get('group/layers', 'ps/group/layers');
    Route::post('group/create', 'ps/group/create');
    Route::post('group/update', 'ps/group/update');
    Route::post('group/delete', 'ps/group/delete');
    Route::get('group/info', 'ps/group/info');
    Route::get('group/all', 'ps/group/all');
    Route::get('searchType', 'ps/index/searchType');
    // 第三版需求属性编辑
    Route::get('canal/fields', 'ps/canal/allFields');
    Route::post('canal/addfield', 'ps/canal/addField');
    Route::post('canal/altfield', 'ps/canal/updateField');
    Route::post('canal/delfield', 'ps/canal/deleteField');

    Route::get('comb/fields', 'ps/canal/allFields');
    Route::post('comb/addfield', 'ps/canal/addField');
    Route::post('comb/altfield', 'ps/canal/updateField');
    Route::post('comb/delfield', 'ps/canal/deleteField');

    Route::get('dirpoint/fields', 'ps/canal/allFields');
    Route::post('dirpoint/addfield', 'ps/canal/addField');
    Route::post('dirpoint/altfield', 'ps/canal/updateField');
    Route::post('dirpoint/delfield', 'ps/canal/deleteField');

    Route::get('pipe/fields', 'ps/canal/allFields');
    Route::post('pipe/addfield', 'ps/canal/addField');
    Route::post('pipe/altfield', 'ps/canal/updateField');
    Route::post('pipe/delfield', 'ps/canal/deleteField');

    Route::get('spout/fields', 'ps/canal/allFields');
    Route::post('spout/addfield', 'ps/canal/addField');
    Route::post('spout/altfield', 'ps/canal/updateField');
    Route::post('spout/delfield', 'ps/canal/deleteField');

    Route::get('well/fields', 'ps/canal/allFields');
    Route::post('well/addfield', 'ps/canal/addField');
    Route::post('well/altfield', 'ps/canal/updateField');
    Route::post('well/delfield', 'ps/canal/deleteField');

})->allowCrossDomain();

Route::group('qy',function () {
    Route::get('searchType', 'qy/index/searchType');
//    Route::get('search', 'qy/index/search');

    Route::post('pipe/create', 'qy/pipe/create');
    Route::post('pipe/update', 'qy/pipe/update');
    Route::get('pipe/info', 'qy/pipe/info');
    Route::post('canal/create', 'qy/canal/create');
    Route::post('canal/delete', 'qy/canal/delete');
    Route::get('canal/info', 'qy/canal/info');
    Route::post('canel/update', 'qy/canal/update');

    // 第三版需求
    Route::get('canal/fields', 'qy/canal/allFields');
    Route::post('canal/addfield', 'qy/canal/addField');
    Route::post('canal/altfield', 'qy/canal/updateField');
    Route::post('canal/delfield', 'qy/canal/deleteField');
    Route::get('pipe/fields', 'qy/canal/allFields');
    Route::post('pipe/addfield', 'qy/canal/addField');
    Route::post('pipe/altfield', 'qy/canal/updateField');
    Route::post('pipe/delfield', 'qy/canal/deleteField');

})->allowCrossDomain();

Route::miss('ps/index/info');

return [

];
