<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"A:\wamp64\www\phptp5\public/../application/index\view\index\register.html";i:1702293444;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理系统</title>
    <link rel="stylesheet" href="/static/css/login.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="login-pane">
            <div class="login-pane-right col-6">
                <form class="login-form" method="post" action="">
                    <input type="text" name="username" id="username" class="username" placeholder="用户名" autocomplete="off">
                    <input type="password" name="password" id="password" class="password" placeholder="密码" autocomplete="off">
                    <select name="identity" id="identity" class="form-control" autocomplete="off">
                        <option value="">请选用户身份</option>
                        <option value="teacher">老师</option>
                        <option value="student">学生</option>
                    </select>
                    <input type="text" name="name" id="name" class="name" placeholder="名字" autocomplete="off">
                    <select name="gender" id="gender" class="form-control" autocomplete="off">
                        <option value="">请选择性别</option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                    <input type="text" name="id-card" id="id-card" class="id-card" placeholder="借书卡号" autocomplete="off">
                    <input type="text" name="phone" id="phone" class="phone" placeholder="手机号" autocomplete="off">
                    <input type="submit" name="register-button" id="register-button" class="register-button" value="注册">
                    <input type="submit" name="login-button" id="login-button" class="login-button" value="返回登录">
                    <span>Version 1.0</span>
                </form>
            </div>
            <div class="login-pane-left col-6">
                <div class="title">
                    <h2>欢迎注册</h2>
                    <h4>图书管理系统</h4>
                </div>
            </div>
            
        </div>
    </div>
</body>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/js/register.js"></script>
</html>