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

    // 验证码配置
    'captcha' => [
        // 验证码位数
        'length' => mt_rand(4, 5),
        // 【KCAPTCHA专用】下方是否显示credits（开启会在高度方向额外增加12px）（注：credit表示对原作者及其他有贡献者的谢启、及鸣谢者姓名）
        'show_credits' => true,
        // 【KCAPTCHA专用】credits内容（如果为空，则显示HTTP_HOST）
        'credits' => 'eeYes.net',
        // 【KCAPTCHA专用】验证码文字颜色
        'foreground_color' => [mt_rand(0, 80), mt_rand(0, 80), mt_rand(0, 80)],
        // 【KCAPTCHA专用】验证码背景颜色
        'background_color' => [mt_rand(220, 255), mt_rand(220, 255), mt_rand(220, 255)],
    ],
];
