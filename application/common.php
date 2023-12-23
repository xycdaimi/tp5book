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
function  uuid()  
{  
    $chars = md5(uniqid(mt_rand(), true));  
    $uuid = substr ( $chars, 0, 8 ) . '-'
            . substr ( $chars, 8, 4 ) . '-' 
            . substr ( $chars, 12, 4 ) . '-'
            . substr ( $chars, 16, 4 ) . '-'
            . substr ( $chars, 20, 12 );  
    return $uuid ;  
}

// 获取搜索类型
function getSearchType($type){
    if($type == "group"){
        return 'groups';
    }
    else if($type == "name"){
        return 'name';
    }
    else if($type == "author"){
        return 'author';
    }
    else if($type == "press"){
        return 'press';
    }
    else if($type == "isbn"){
        return 'isbn';
    }
}

function getSearchUsersType($type){
    if($type == "name"){
        return 'name';
    }
    else if($type == "id-card"){
        return 'id_card';
    }
    else if($type == "phone"){
        return 'phone';
    }
    else if($type == "username"){
        return 'username';
    }
}
function getUserIdentity($type){
    if($type == 'student'){
        return '学生';
    }
    else if($type == 'teacher'){
        return '老师';
    }
}