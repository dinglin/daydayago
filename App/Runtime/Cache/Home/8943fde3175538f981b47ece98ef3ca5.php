<?php if (!defined('THINK_PATH')) exit();?>
<!-- Begin page content -->
<div class="container">
<div class="reg_title"><span class="reg_t_left">用户注册</span>|<span class="reg_t_right">已有账号，<a href="<?php echo U('Home/Index/');?>">去登陆</a></span></div>
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
    <div class="input-prepend">
      <span class="add-on"><i class="icon-user"></i></span>
      <input class="span2" id="inputIcon" type="text" placeholder="用户名">
    </div>
  </div>
  <div class="controls">
    <button class="btn btn-primary" type="button" style="width:165px;">注册</button>
  </div>
</div>
</div>