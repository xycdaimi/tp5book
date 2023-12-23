$(function(){
    
    // 返回登录按钮
    $('#login-button').click(function (e) { 
        e.preventDefault();
        window.location.replace('login');
    });
    //注册按钮
    $('#register-button').click(function (e) { 
        e.preventDefault();
        var registerForm = new FormData($('.login-form')[0]);

        // 获取输入信息
        var username = registerForm.get('username');
        var password = registerForm.get('password');
        var name = registerForm.get('name');
        var gender = registerForm.get('gender');
        var idCard = registerForm.get('id-card');
        var phone = registerForm.get('phone');
        var identity = registerForm.get('identity');

        // 判断输入信息
        if(name == ''){
            alert("请输入名字");
        }
        else if(username == ''){
            alert("请输入用户名");
        }
        else if(password == ''){
            alert("请输入密码");
        }
        else if(gender == ''){
            alert("请输入性别");
        }
        else if(idCard == ''){
            alert("请输入借书卡号");
        }
        else if(phone == ''){
            alert("请输入手机号");
        }
        else if(identity == ''){
            alert("请输入身份");
        }
        else{
            register(registerForm);
        }
    });
    
});

//注册
function register(registerForm){
    $.ajax({
        type: "post",
        url: "index/register",
        data: registerForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data);
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("注册成功");
                window.location.replace('user');
            }
            else if(jsonData.resultCode == 1){
                alert("借记卡号已存在");
            }
            else if(jsonData.resultCode == 2){
                alert("手机号已存在");
            }
            else if(jsonData.resultCode == 3){
                alert("用户名已存在");
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