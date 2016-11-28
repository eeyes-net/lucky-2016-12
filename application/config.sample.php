<?php
return [
    // 应用调试模式
    'app_debug' => false,
    // 应用Trace
    'app_trace' => false,

    // URL伪静态后缀
    'url_html_suffix' => '',
    // 是否强制使用路由
    'url_route_must' => true,

    // 视图输出字符串内容替换
    'view_replace_str' => [
        '__PUBLIC__' => '',
        // 静态资源网址
        '__IMG__' => 'http://img.eeyes.net/lucky',
    ],

    // 图片上传位置
    'image_upload_dir' => '/www/img-2016-07/lucky',
];
