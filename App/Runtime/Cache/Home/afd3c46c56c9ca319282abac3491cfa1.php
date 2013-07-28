<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<meta name="Description" content="<?php echo ($html_head_description); ?>">
<meta name="Keywords" content="<?php echo ($html_head_keywords); ?>">
<!-- Bootstrap -->
<?php if(!empty($app_source_third_css) ): if(is_array($app_source_third_css)): foreach($app_source_third_css as $key=>$vo): ?><link href="__PUBLIC__/<?php echo ($vo); ?>" rel="stylesheet" media="screen"><?php endforeach; endif; endif; ?>
<?php if(!empty($app_source_css) ): if(is_array($app_source_css)): foreach($app_source_css as $key=>$vo): ?><link href="__PUBLIC__/<?php echo ($app_source_path); echo ($vo); ?>" rel="stylesheet" ><?php endforeach; endif; endif; ?>
<title><?php echo ($html_head_title); ?></title>
</head>
<body>
<div id="header">
<div class="logo"></div>
<div class="login_info"></div>
</div>

<!-- Begin page content -->
<div class="container">
<form method='post' id="login" name="form1" action="<?php echo ($index_login_url); ?>" >
<div class="control-group" id="login_dialog">
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" name="user-mail" id="login-mail" type="text" placeholder="邮箱">
    </div>
  </div>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-lock"></i></span>
      <input class="span2" name="user-pwd" id="login-pwd" type="password" placeholder="密码">
    </div>
  </div>
  <div class="controls">
    <button class="btn btn-primary" id="login_btn" type="button" style="width:165px;">登录</button>
    <a href="javascript:void(0);" class="to_register" id="to_register">去注册</a>
  </div>
</div>
</form>
<form method='post' id="regist" name="form2" action="__URL__/regist">
<div class="control-group" id="register_dialog" >
 <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" name="user-mail" id="regist-mail" type="text" placeholder="邮箱">
    </div>
  </div>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-lock"></i></span>
      <input class="span2" name="user-pwd" id="regist-pwd" type="password" placeholder="密码">
    </div>
  </div>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-user"></i></span>
      <input class="span2" name="user-name" id="regist-name" type="text" placeholder="用户名">
    </div>
  </div>
  <div class="controls">
    <button class="btn btn-primary" id="regist_btn" type="button" style="width:165px;">注册</button>
    <a href="javascript:void(0);" class="to_register" id="to_login">去登陆</a>
  </div>
</div>
</form>
<div class="error_log"><span id="mail_error"></span><span id="pwd_error"></span><span></span></div>
</div>
<script type="text/javascript">
<!--
var check_mail_url = "__URL__/check_mail";
//-->
</script>
<div id="footer">
    <div class="container"></div>
</div>
<?php if(!empty($app_source_third_js) ): if(is_array($app_source_third_js)): foreach($app_source_third_js as $key=>$vo): ?><script src="__PUBLIC__/<?php echo ($vo); ?>"></script><?php endforeach; endif; endif; ?>
<?php if(!empty($app_source_js) ): if(is_array($app_source_js)): foreach($app_source_js as $key=>$vo): ?><script src="__PUBLIC__/<?php echo ($app_source_path); echo ($vo); ?>"></script><?php endforeach; endif; endif; ?>
</body>
</html>