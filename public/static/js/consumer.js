$(function(){

   

    // 删除用户按钮
    $(document).on('click', '.btn-delete', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var id = $(this).attr('name');

        // 设置名字
        $('.delete-user-button').attr('id', id);
    });

    $(document).on('click', '.delete-user-button', function (e) {
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var deleteForm = new FormData();

        // 添加表单数据
        deleteForm.append('id', id);
        
        // 删除用户
        deleteUser(deleteForm);
    });

    // 编辑用户按钮
    $(document).on('click', '.btn-edit', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('name');

        // 设置名字
        $('.edit-user-button').attr('id', id);
    });

    $(document).on('click', '.edit-user-button', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var editForm = new FormData($('#edit-user-form')[0]);

        // 添加表单数据
        editForm.append('id', id);
        
        // 更新用户
        editUser(editForm);
    });
});
// 删除用户
function deleteUser(deleteForm){
    $.ajax({
        type: "post",
        url: "deleteUser",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if(jsonData.resultCode == 0){
                alert("删除失败，该用户不存在");
            }
            else if(jsonData.resultCode == 1){
                alert("删除成功");
                window.location.replace('./');
            }
            else if(jsonData.resultCode == 2){
                alert("删除成功");
                top.location.replace('/');
            }
            else{
                alert("服务器错误");
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 编辑用户
function editUser(editForm){
    $.ajax({
        type: "post",
        url: "editUser",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("编辑失败");
            }
            else if(jsonData.resultCode == 1){
                alert("编辑成功");
                window.location.reload('./');
            }
            else if(jsonData.resultCode == -1){
                alert("修改后该用户有超过上限借阅的书籍");
            }
            else if(jsonData.resultCode == -2){
                alert("用户名已存在");
            }
            else if(jsonData.resultCode == -3){
                alert("借记卡号已存在");
            }
            else if(jsonData.resultCode == -4){
                alert("手机号已存在");
            }
            else{
                alert("出现错误");
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}