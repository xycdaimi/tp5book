<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"A:\wamp64\www\phptp5\public/../application/index\view\index\login.html";i:1702308088;}*/ ?>
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
            <div class="login-pane-left col-6">
                <div class="title">
                    <h2>欢迎登录</h2>
                    <h4>图书管理系统</h4>
                </div>
            </div>
            <div class="login-pane-right col-6">
                <form class="login-form" method="post" action="">
                    <input type="text" name="username" id="username" class="username" placeholder="用户名" autocomplete="off">
                    <input type="password" name="password" id="password" class="password" placeholder="密码" autocomplete="off">
                    <input type="submit" name="login-button" id="login-button" class="login-button" value="登录">
                    <input type="submit" name="register-button" id="register-button" class="register-button" value="注册">
                    <span>Version 1.0</span>
                    <span><a href="" data-toggle="modal" data-target="#password-modal">忘记密码</a></span>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="password-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">找回密码</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="password-form">
                    <div class="form-item">
                        <label for="password-name"><span class="must">*</span>名字</label>
                        <input type="text" name="password-name" id="password-name" class="form-control" placeholder="名字">
                    </div>
                    <div class="form-item">
                        <label for="password-id-card"><span class="must">*</span>借书卡号</label>
                        <input type="text" name="password-id-card" id="password-id-card" class="form-control" placeholder="借书卡号">
                    </div>
                    <div class="form-item">
                        <label for="password-phone"><span class="must">*</span>手机号</label>
                        <input type="text" name="password-phone" id="password-phone" class="form-control" placeholder="手机号">
                    </div>
                    <div class="form-item">
                        <label for="password-password"><span class="must">*</span>新密码</label>
                        <input type="text" name="password-password" id="password-password" class="form-control" placeholder="新密码">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-success password-button" id="password-button">修改</button>
            </div>
            </div>
        </div>
    </div>
</body>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/js/login.js"></script>
</html>