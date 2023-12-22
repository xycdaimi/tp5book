$(function(){
    // 归还图书按钮
    $(document).on('click', '.btn-return', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var name = $(this).parent().parent().find('.name').text();
        var id = $(this).attr('name');
        // 设置名字
        $('#return-name').text(name);
        $('.return-book-button').attr('id', id);
    });

    $(document).on('click', '.return-book-button', function (e) { 
        e.preventDefault();
        
        // 表单
        var returnForm = new FormData($('#return-form')['0']);

        // 获取数据
        var id = $(this).attr('id');

        returnForm.append("id", id);

        // 归还图书
        returnBook(returnForm);
    });
});
// 归还图书
function returnBook(returnForm){
    $.ajax({
        type: "post",
        url: "backBook",
        data: returnForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var jsonData = JSON.parse(data);
            console.log(data);

            if(jsonData.resultCode == 0){
                alert("归还图书失败，此书不存在");
            }
            else if(jsonData.resultCode == 1){
                alert("归还成功");
                window.location.reload('./');
            }
            else if(jsonData.resultCode == -2){
                alert("你没有借过书");
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