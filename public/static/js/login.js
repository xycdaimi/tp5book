$(function(){
    
    // 登录按钮
    $('#login-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var loginForm = new FormData($('.login-form')[0]);
        
        var username = loginForm.get('username');
        var password = loginForm.get('password');

        // 判断表单内容
        if(username == ''){
            alert("请输入用户名");
        }
        else if(password == ''){
            alert("请输入密码");
        }
        else{
            loginForm.append('request', 'login');
            login(loginForm);
        }
    });
    //注册按钮
    $('#register-button').click(function (e) { 
        e.preventDefault();
        window.location.replace('register');
    });

    $('#password-button').click(function (e) { 
        e.preventDefault();
        // 获取表单
        var passwordForm = new FormData($('#password-form')[0]);
        var name= passwordForm.get('password-name');
        var idCard = passwordForm.get('password-id-card');
        var phone = passwordForm.get('password-phone');
        var newPassword = passwordForm.get('password-password');

        if(name == ''){
            alert("请输入名字");
        }
        else if(idCard == ''){
            alert("请输入借记卡号");
        }
        else if(phone == ''){
            alert("请输入手机号");
        }
        else if(newPassword == ''){
            alert("请输入新密码");
        }
        else{
            passwordForm.append('request', 'repassword');
            repassword(passwordForm);
        }
    });
    
});
//登录
function login(loginForm){
    $.ajax({
        type: "post",
        url: "index/login",
        data: loginForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if(jsonData.resultCode == 0){
                alert("用户名或密码错误");
                var img = document.getElementById("image");
                img.src=img.src+'?'+Math.random();
            }
            else if(jsonData.resultCode == 1){
                alert("登录成功");
                window.location.replace('user');
            }
            else if(jsonData.resultCode == 2){
                alert("登录成功");
                window.location.replace('admin');
            }
            else if(jsonData.resultCode == -1){
                alert("验证码错误");
                var img = document.getElementById("image");
                img.src=img.src+'?'+Math.random();
            }
            else{
                alert('出现错误');
                var img = document.getElementById("image");
                img.src=img.src+'?'+Math.random();
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器出错");
            // 日志
            console.log(data);
        }
    });
}

function repassword(passwordForm){
    $.ajax({
        type: "post",
        url: "index/login/repassword",
        data: passwordForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data);
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("没有对应账号");
            }
            else if(jsonData.resultCode == 1){
                alert("修改成功");
            }
            else{
                alert('出现错误');
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器出错");
            // 日志
            console.log(data);
        }
    });
}