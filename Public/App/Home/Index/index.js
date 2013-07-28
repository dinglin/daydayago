
$('#to_register').click(function(){
    $('#login_dialog').hide();
    $('#register_dialog').show("slow");
});
$('#to_login').click(function(){
    $('#register_dialog').hide();
    $('#login_dialog').show("slow");
});
$('#login_btn').click(function(){
    var res_m = check_mail($("#login-mail"));
    var res_p = check_pwd($("#login-pwd"));
    if( res_m && res_p){
        $("#login").submit();
    }
});

function check_mail(obj){
    var email = $.trim($(obj).val());
    if(email == ""){
        $("#mail_error").text("邮箱不能为空");
        return false;
    }
    var pattern=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]w+)*$/;
    if(!pattern.test(email)){
        $("#mail_error").text("邮箱格式不正确");
        return false;
    }
    return true;
}
function check_pwd(obj){
    var pwd = $.trim($(obj).val());
    if(pwd == ""){
        $("#pwd_error").text("密码不能为空");
        return false;
    }
    var len = pwd.length;
    if(len<6 || len>16){
        $("#pwd_error").text("密码长度在6-16位");
        return false;
    }
    return true;
}