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
    Route::post('pipe/create', 'ps/pipe/create');
    Route::post('pipe/delete', 'ps/pipe/delete');
    Route::get('pipe/info', 'ps/pipe/info');
    Route::post('canal/create', 'ps/canal/create');
    Route::post('canal/delete', 'ps/canal/delete');
    Route::post('dirpoint/create', 'ps/dirpoint/create');
    Route::post('dirpoint/delete', 'ps/dirpoint/delete');
    Route::post('alterdia/create', 'ps/alterdia/create');
    Route::post('alterdia/delete', 'ps/alterdia/delete');
    Route::post('spout/create', 'ps/spout/create');
    Route::post('spout/delete', 'ps/spout/delete');
    Route::post('well/create', 'ps/well/create');
    Route::post('well/delete', 'ps/well/delete');
    Route::post('comb/create', 'ps/comb/create');
    Route::post('comb/delete', 'ps/comb/delete');
    Route::post('prepro/create', 'ps/prepro/create');
    Route::post('prepro/delete', 'ps/prepro/delete');
    Route::get('prepro/info', 'ps/prepro/info');
})->crossDomainRule();

Route::miss('ps/index/info');

return [

];
