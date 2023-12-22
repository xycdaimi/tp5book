$(function(){
    // 初始化
    init();

});
// 初始化
function init(){
    getTime();
}
// 系统时间
function getTime(){
    setInterval(function(){
        var date = new Date();
        var year = date.getFullYear();    //获取当前年份
        var mon = date.getMonth()+1;      //获取当前月份
        var da = date.getDate();          //获取当前日
        var day = date.getDay();          //获取当前星期几
        var h = date.getHours();          //获取小时
        var m = date.getMinutes();        //获取分钟
        var s = date.getSeconds();        //获取秒
        var weeks = new Array("日", "一", "二", "三", "四", "五", "六"); //星期
        if(h<10){h = '0' + h;}
        if(m<10){m = '0' + m;}
        if(s<10){s = '0' + s;}
        $('.time .subtitle').text(year+'-'+mon+'-'+da+' '+'星期'+weeks[day]+' '+h+':'+m+':'+s);
    },1);
}