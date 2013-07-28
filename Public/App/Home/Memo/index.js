$(function() {
    jQuery(function($){
        $.datepicker.regional['zh-CN'] = {
        closeText: '关闭',
        prevText: '&#x3C;上月',
        nextText: '下月&#x3E;',
        currentText: '今天',
        monthNames: ['一月','二月','三月','四月','五月','六月',
        '七月','八月','九月','十月','十一月','十二月'],
        monthNamesShort: ['一月','二月','三月','四月','五月','六月',
        '七月','八月','九月','十月','十一月','十二月'],
        dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
        dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
        dayNamesMin: ['日','一','二','三','四','五','六'],
        weekHeader: '周',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: true,
        yearSuffix: '年'};
        $.datepicker.setDefaults($.datepicker.regional['zh-CN']);
        }); 
    add_datepicker("date_start",date_today,one_month_later);
    add_datepicker("date_end",date_today,one_month_later);
    $( "#radio_weight" ).buttonset();
    $( "#radio_public" ).buttonset();
    
    $("#notice_time").change(function(){
        if($(this).val() == ""){
            $(this).removeClass("dda_input_content_color");
            $(this).addClass("dda_input_default_color");
        }else{
            $(this).removeClass("dda_input_default_color");
            $(this).addClass("dda_input_content_color");
        }
        check_now_notice_time();
    });
    $("#date_start").change(function(){
        check_now_notice_time();
    });
    $("#date_end").change(function(){
        check_now_notice_time();
    });
  //打开高级
    $("#input_memo_larger").click(function(){
        check_is_larger(false);
        $("#input_memo_set").toggle("slow");
    });
    $("#input_memo_larger").mouseover(function(){
        $("#icon_th_large").removeClass("icon-white");
    });
    $("#input_memo_larger").mouseout(function(){
        $("#icon_th_large").addClass("icon-white");
    });
    $("#memo_content").keyup(function(){
        check_input_content();
    });
});
function set_time(time,now_time){
    var i ;
    var html='<select name="time" id="notice_time" class="span2 dda_input_default_color">';
    for(i in time){
        if(time[i].val == "AM" || time[i].val == "PM"){
            html+='<optgroup label="'+time[i].val+'">'+time[i].key+'</optgroup>';
        }else if(now_time == time[i].val){
            html+='<option selected value="'+time[i].val+'">'+time[i].key+'</option>';
        }else{
             html+='<option value="'+time[i].val+'">'+time[i].key+'</option>';
        }
    }
    html += '</select>';
    $("#notice_time").html(html);
}
function check_now_notice_time(){
    var time = $('#notice_time').val();
    var date_start = $('#date_start').val();
    var date_end   = $('#date_end').val();
    var text = "";
    var time_all_select = time_all;
    if(time!="" && date_start!="" && date_end!=""){
        if(date_start != date_end){
            text = date_start+" 到 "+date_end+" ，每天 ";
        }else{
            if(date_today == date_start){
                time_all_select = time_today
                text = "今天 ";
            }else if(date_tomorrow == date_start){
                text = "明天 ";
            }else{
                text = date_start+"，";
            }
        }
    }else if(time!="" && date_start!=""){
        if(date_today == date_start){
            time_all_select = time_today
            text = "今天 ";
        }else if(date_tomorrow == date_start){
            text = "明天 ";
        }else{
            text = date_start+"，";
        }
    }else if(time!="" && date_end!=""){
        if(date_today == date_end){
            time_all_select = time_today
            text = "今天 ";
        }else if(date_tomorrow == date_end){
            text = "明天 ";
        }else{
            text = date_end+"，";
        }
    }else if(time!=""){
        time_all_select = time_today
        text = "今天 ";
    }
    set_time(time_all_select,time);
    time = $('#notice_time').val();
    if(time!=""){
        var input_notice = text + time+" 点的备忘录";
        text = text + time+" 点提醒";
        $("#info_time_notice").html(text);
        $('#memo_content').attr("placeholder",input_notice);
    }else{
        $('#memo_content').attr("placeholder","今天的备忘录");
        $("#info_time_notice").html(" ");
    }
}
function check_input_content(){
    $("#error_control_input_memo").removeClass("error");
    var _info = $("#memo_content_length");
    var _val = $("#memo_content").val();
    var _cur = getByteLen(_val);

    if (_cur == 0) {//当默认值长度为0时,可输入数为默认maxlength值
        _info.text(max_length);
    } else if (_cur < max_length) {//当默认值小于限制数时,可输入数为max-cur
        var len = parseInt((max_length - _cur)/2);
        _info.text(len);
    } else {//当默认值大于等于限制数时
        _info.text(0);
        $("#memo_content").val(getByteVal(_val,max_length)); //截取指定字节长度内的值
    }
    return _cur;
}
//日历
function add_datepicker(id,date_min,date_max){
  $( "#"+id ).datepicker({
        dateFormat:"yy-mm-dd",
        showAnim:"drop",
       // $.datepicker.regional[ "zh-TW" ],
        showWeek: true,
        firstDay: 1,
        //changeMonth: true,
        numberOfMonths: 2,
        minDate: date_min, 
        maxDate: date_max,
        onClose: function( selectedDate ) {
            if(id == "date_start"){
                if(selectedDate == ""){
                    selectedDate = date_today;
                }
                $( "#date_end" ).datepicker( "option", "minDate", selectedDate );
            }else if(id == "date_end"){
                if(selectedDate == ""){
                    selectedDate = one_month_later;
                }
                $( "#date_start" ).datepicker( "option", "maxDate", selectedDate );
            }
        }
    });
  $( "#"+id ).datepicker( "option",$.datepicker.regional[ 'zh-CN' ] );
}
function check_is_larger(flag){
    var status_large = $('#input_memo_set').css('display');
    var is_larger = $('#is_larger');
    if(flag){
        if(status_large == "none"){
            is_larger.val(0);
        }else {
            is_larger.val(1);
        }
    }else{
        if(status_large == "none"){
            is_larger.val(1);
        }else {
            is_larger.val(0);
        }
    }
}
//禁止粘贴文本框
function forbiddance_paste(evt)
{
    if(!window.event)
    {
        var keycode = evt.keyCode;
        var key = String.fromCharCode(keycode).toLowerCase();
        if(evt.ctrlKey && key == "v")
        {
           evt.preventDefault();
           evt.stopPropagation();
        }
        if(evt.ctrlKey && key == "x")
        {
           evt.preventDefault();
           evt.stopPropagation();
        }
    }
}
function getByteLen(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        if (val[i].match(/[^\x00-\xff]/ig) != null) //全角
            len += 2;
        else
            len += 1;
    }
    return len;
}

//返回val在规定字节长度max内的值
function getByteVal(val, max) {
    var returnValue = '';
    var byteValLen = 0;
    for (var i = 0; i < val.length; i++) {
        if (val[i].match(/[^\x00-\xff]/ig) != null)
            byteValLen += 2;
        else
            byteValLen += 1;

        if (byteValLen > max)
            break;

        returnValue += val[i];
    }
    return returnValue;
}
//表达提交
function do_submit(){
    check_is_larger(true);
    var len = check_input_content();
    if(len>0 && len<=max_length){
        $("#memo_form").submit();
    }else{
        $("#error_control_input_memo").addClass("error");
    }
    
}
