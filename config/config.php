<?php
return [
    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => true,
    //是否开启路由
    'url_route_on'           => true,
    'url_route_must'         => false,
    'view_replace_str' => [
        '__JS__'                 =>'/static/js',
        '__CSS__'                =>'/static/css',
        '__IMG__'                =>'/static/img',
        '__BC__'                 =>'/static/bootstrap/css',
        '__Bj__'                 =>'/static/bootstrap/js',
        '__FONT__'               =>'/static/font',
    ],
    'tpl_cache'=>false,
];
?>