$(function(){
    // 搜索图书按钮
    $(document).on('click', '.search-button', function (e) { 
        e.preventDefault();

        // 获取表单
        var searchForm = new FormData($('#search-form')[0]);

        // 获取信息
        var searchText = searchForm.get('search-text');

        // 判断信息
        if(searchText == ''){
            alert("请输入要搜索的图书ISBN号码");
        }
        else{
            searchForm.append("text",searchText);
            searchForm.delete("search-text");
            searchBook(searchForm);
        }
    });

    // 借阅图书按钮
    $(document).on('click', '.borrow-button', function (e) { 
        e.preventDefault();
        
        // 获取表单
        var borrowForm = new FormData($('#borrow-form')[0]);

        // 获取信息
        var isbn = $('#search-text').val();
        var bookname = $('.book-name').text();
        var username = borrowForm.get('username');
        var idCard = borrowForm.get('id-card');
        var phone = borrowForm.get('phone');
        
        // 判断信息
        if(isbn == '' || bookname == ''){
            alert("请输入借阅的图书 ISBN 号码");
        }
        else if(username == ''){
            alert("请输入借阅人用户名");
        }
        else if(idCard == ''){
            alert("请输入借阅人卡号");
        }
        else if(phone == ''){
            alert("请输入借阅人手机号");
        }
        else{
            borrowForm.append("type", "borrow");
            borrowForm.append("bookname", bookname);
            borrowForm.append("isbn", isbn);
            borrowBook(borrowForm);
        }
    });
});

// 搜索图书
function searchBook(searchForm){
    $.ajax({
        type: "post",
        url: "search",
        data: searchForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data);
            // 设置信息
            $('.book-name').text(data.name);
            $('.book-author').text(data.author);
            $('.book-press').text(data.press);
            $('.book-isbn').text(data.isbn);
            $('.book-quantity').text(data.quantity);
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 借阅图书
function borrowBook(borrowForm){
    $.ajax({
        type: "post",
        url: "borrowBook",
        data: borrowForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);

            if(jsonData.resultCode == 0){
                alert("借阅图书失败，借阅人身份不存在或该图书库存不足");
            }
            else if(jsonData.resultCode == 1){
                alert("借阅成功");
                window.location.reload('./');
            }
            else if(jsonData.resultCode == -1){
                alert("借阅错误");
            }
            else if(jsonData.resultCode == -2){
                alert("借阅日志信息错误");
            }
            else if(jsonData.resultCode == -3){
                alert("用户信息错误");
            }
            else if(jsonData.resultCode == -4){
                alert("用户已达借阅次数上限");
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