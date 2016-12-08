<?php
use think\Route;
// 主页
Route::get('/','index/index/index');
// 上传背景图片并新建抽奖页面
Route::post('create','index/index/createScreen');
// 抽奖页面
Route::get('screen/:name','index/index/screen');
// 获取头像
Route::get('avatar/:url','index/index/avatar');
