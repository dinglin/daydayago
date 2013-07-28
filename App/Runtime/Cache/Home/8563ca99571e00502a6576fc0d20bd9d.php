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
<?php if(!empty($app_source_css) ): ?><link href="__PUBLIC__/<?php echo ($app_source_path); echo ($app_source_css); ?>" rel="stylesheet" ><?php endif; ?>
<title><?php echo ($html_head_title); ?></title>
</head>
<body>
<div id="header">
<!-- 登录 -->
 <?php if($_SESSION['user_name']): ?><div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="header_top_content">
                <a class="brand" href="#">DayDayAgo</a>
                <ul class="nav">
                    <li class="<?php echo ($active=='home'?'active':''); ?>"><a href="/home">首页</a></li>
                    <li class="<?php echo ($active=='index'?'active':''); ?>"><a href="/">个人主页</a></li>
                    <li class="<?php echo ($active=='plan'?'active':''); ?>"><a href="<?php echo ($plan_url); ?>">计划</a></li>
                    <li class="<?php echo ($active=='memo'?'active':''); ?>"><a href="<?php echo ($memo_url); ?>">备忘录</a></li>
                </ul>
                <div class="header_top_right">
	                <ul class="nav">
	                    <li><a href="#"><i class="icon-user"></i> <?php echo (session('user_name')); ?></a></li>
	                    <li><a href="#"><i class="icon-wrench"></i> 设置</a></li>
	                    <li><a href="<?php echo ($lougout_url); ?>"><i class="icon-off"></i> 退出</a></li>
	                </ul>
                </div>
            </div>
        </div>
    </div>
 <?php else: ?>
 <!-- 未登录 --><?php endif; ?>
</div>
<!-- Begin page content -->
<div class="container dda_content_top">
    <div class="row">
    <?php echo ($plan["title"]); ?>
    <?php echo ($plan["content"]["content"]); ?>
    </div>
</div>
<div id="footer">
    <div class="container"></div>
</div>
<?php if(!empty($app_source_third_js) ): if(is_array($app_source_third_js)): foreach($app_source_third_js as $key=>$vo): ?><script src="__PUBLIC__/<?php echo ($vo); ?>"></script><?php endforeach; endif; endif; ?>
<?php if(!empty($app_source_js) ): ?><script src="__PUBLIC__/<?php echo ($app_source_path); echo ($app_source_js); ?>"></script><?php endif; ?>
</body>
</html>