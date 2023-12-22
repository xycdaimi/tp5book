$(function(){

    // 添加图书按钮
    $(document).on('click', '.add-book-button', function (e) { 
        e.preventDefault();
        
        // 获取表单信息
        var addForm = new FormData($('#add-book-form')[0]);

        // 获取输入信息
        var group = addForm.get('add-group');
        var name = addForm.get('add-name');
        var author = addForm.get('add-author');
        var press = addForm.get('add-press');
        var price = addForm.get('add-price');
        var count = addForm.get('add-count');
        var isbn = addForm.get('add-isbn');

        // 判断输入信息
        if(group == ''){
            alert("请选择组别");
        }
        else if(name == ''){
            alert("请输入名字");
        }
        else if(author == ''){
            alert("请输入作者");
        }
        else if(press == ''){
            alert("请输入出版社");
        }
        else if(price == ''){
            alert("请输入价格");
        }
        else if(count == ''){
            alert("请输入书本数量");
        }
        else if(isbn == ''){
            alert("请输入 ISBN 号码");
        }
        else{
            addBook(addForm);
        }
    });

    // 删除图书按钮
    $(document).on('click', '.btn-delete', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var name = $(this).parent().parent().find('.name').text();
        var id = $(this).attr('name');

        // 设置名字
        $('#delete-name').text(name);
        $('.delete-book-button').attr('id', id);
    });

    $(document).on('click', '.delete-book-button', function (e) {
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var deleteForm = new FormData();

        // 添加表单数据
        deleteForm.append('id', id);
        
        // 删除图书
        deleteBook(deleteForm);
    });

    // 编辑图书按钮
    $(document).on('click', '.btn-edit', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('name');

        // 设置名字
        $('.edit-book-button').attr('id', id);
    });

    $(document).on('click', '.edit-book-button', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var editForm = new FormData($('#edit-book-form')[0]);

        // 添加表单数据
        editForm.append('id', id);
        
        // 删除图书
        editBook(editForm);
    });
});

//添加图书
function addBook(addForm){
    $.ajax({
        type: "post",
        url: "addBook",
        data: addForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if(jsonData.resultCode == 0){
                alert("添加图书失败，ISBN号码存在");
            }
            else if(jsonData.resultCode == 1){
                alert("添加图书成功");
                window.location.reload('./');
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

// 删除图书
function deleteBook(deleteForm){
    $.ajax({
        type: "post",
        url: "deleteBook",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            if(jsonData.resultCode == 0){
                alert("删除失败，该图书不存在");
            }
            else if(jsonData.resultCode == 1){
                alert("删除成功");
                window.location.reload('./');
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

// 编辑图书
function editBook(editForm){
    $.ajax({
        type: "post",
        url: "editBook",
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