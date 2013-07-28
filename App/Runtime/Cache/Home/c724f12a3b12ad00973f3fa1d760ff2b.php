<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="__PUBLIC__/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="__PUBLIC__/Css/Index/index.css" rel="stylesheet" >
<title>Insert title here</title>
</head>
<body>
<div id="header"></div>

<!-- Begin page content -->
<div class="container">

<div class="control-group">
 <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" id="inputIcon" type="text" placeholder="邮箱">
    </div>
  </div>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-lock"></i></span>
      <input class="span2" id="inputIcon" type="text" placeholder="密码">
    </div>
  </div>
  <div class="controls">
    <button class="btn btn-primary" type="button">登录</button>
    <a target="_blank" href="<?php echo U('Home/Register/');?>">注册</a>
  </div>
</div>

</div>

<div id="footer">
    <div class="container"></div>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>