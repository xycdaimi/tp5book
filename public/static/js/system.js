$(function(){
    
    // 添加图书种类按钮
    $('.add-type-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var addForm = new FormData($('#add-type-form')[0]);

        // 获取信息
        var name = addForm.get('add-type-name');

        if(name == ''){
            alert("请输入图书种类名");
        }
        else{
            addTypeName(addForm);
        }
    });


    // 修改图书种类按钮
    $('.edit-type-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var editForm = new FormData($('#edit-type-form')[0]);

        // 获取信息
        var oldname = editForm.get('edit-old-type-name');
        var newname = editForm.get('edit-new-type-name');

        if(oldname == ''){
            alert("请输入旧图书种类名");
        }
        else if(newname == ''){
            alert("请输入新图书种类名");
        }
        else{
            editTypeName(editForm);
        }
    });

    // 删除图书种类按钮
    $('.delete-type-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var deleteForm = new FormData($('#delete-type-form')[0]);

        // 获取信息
        var name = deleteForm.get('delete-type-name');

        if(name == ''){
            alert("请输入图书种类名");
        }
        else{
            deleteTypeName(deleteForm);
        }
    });

    // 修改管理员密码按钮
    $('.edit-admin-password-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var editForm = new FormData($('#edit-admin-form')[0]);

        // 获取信息
        var name = editForm.get('edit-admin-password');

        if(name == ''){
            alert("请输入新密码");
        }
        else{
            editAdminPassword(editForm);
        }
    });
});

// 添加图书种类
function addTypeName(addForm){
    $.ajax({
        type: "post",
        url: "addBookType",
        data: addForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("图书种类已存在");
            }
            else if(jsonData.resultCode == 1){
                alert("添加成功");
                window.location.reload('./');
            }
            else if(jsonData.resultCode == -1){
                alert("该图书种类在书库中还有库存书籍");
            }
            else{
                alert("出现错误")
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

// 修改图书种类
function editTypeName(editForm){
    $.ajax({
        type: "post",
        url: "editBookType",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if(jsonData.resultCode == 0){
                alert("旧图书种类不存在");
            }
            else if(jsonData.resultCode == 1){
                alert("修改成功");
                window.location.reload('./');
            }
            else if(jsonData.resultCode == -1){
                alert("修改失败");
            }
            else{
                alert("出现错误")
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


// 删除图书种类
function deleteTypeName(deleteForm){
    $.ajax({
        type: "post",
        url: "deleteBookType",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("图书种类不存在");
            }
            else if(jsonData.resultCode == 1){
                alert("删除成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误")
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

// 修改管理员密码
function editAdminPassword(editForm){
    $.ajax({
        type: "post",
        url: "editAdminPassword",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("修改失败");
            }
            else if(jsonData.resultCode == 1){
                alert("修改成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误")
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