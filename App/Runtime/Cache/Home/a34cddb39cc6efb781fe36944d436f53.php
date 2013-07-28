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
       <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav affix">
                <li class="active"><a href="#home" data-toggle="tab">我的计划</a></li>
                <li><a href="#home" data-toggle="tab">给XXX的任务</a></li>
            </ul>
       </div>
       <div class="span9">
                <div class="span10" id="input_memo_set_hide">
                    <form action="" method="post" id="plan_form" class="form-horizontal">
                         <div class="control-group" id="error_control_input_memo">
                            <div class="controls">
                               <input type="text" name="title" id="plan_title" class="dda_memo_content" placeholder="计划"  />
                               <span class="help-inline" ><b><span id="memo_content_length"><?php echo ($max_length/2); ?></span></b>字</span>
                            </div>
                         </div>
                         <div class="accordion dda_accordion" id="accordion2">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                        <i class="icon-book"></i>&nbsp;&nbsp;描述
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                    <textarea rows="" cols="" name="detail"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                        <i class="icon-time"></i>&nbsp;&nbsp;时间
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <div class="control-group">
                                               <div class="controls controls-row">
                                                   <input type="text" id="date_start" name="date_start" placeholder="开始日期"/> 
                                                   <input type="text"  id="date_end" name="date_end" placeholder="结束日期"/>
                                               </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                        <i class="icon-wrench"></i>&nbsp;&nbsp;设置
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                       <div class="control-group">
                                           <div id="radio_public" class="ui-buttonset controls">
                                                <input type="radio" name="is_public" id="radio10" class="ui-helper-hidden-accessible" value="0" checked="checked">
                                                <label for="radio10" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-state-active" role="button" aria-disabled="false" aria-pressed="true">
                                                    <span class="ui-button-text">仅自己可见</span>
                                                </label>
                                                <!-- <input type="radio" name="is_public" id="radio2" class="ui-helper-hidden-accessible" value="1">
                                                <label for="radio2" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false" aria-pressed="false">
                                                    <span class="ui-button-text">重要</span>
                                                </label> -->
                                                <input type="radio" name="is_public" id="radio12" class="ui-helper-hidden-accessible" value="2">
                                                <label for="radio12" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false" aria-pressed="false">
                                                    <span class="ui-button-text">所有人可见</span>
                                                </label>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="control-group">
                            <div class="controls">
                                <input name="is_larger" type="hidden" value="0" id="is_larger">
                                <a class="dda_btn" onclick="do_submit()" >好的，保存</a> 
                                <span id="input_memo_larger" class="pointer"><i id="icon_th_large" class="icon-th-large icon-white"></i>高级</span>
                                <p class="text-error"><?php echo ($error_msg); ?></p>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
     </div>
</div>
<script type="text/javascript">
<!--
var date_today="<?php echo ($today); ?>";
var date_tomorrow = "<?php echo ($tomorrow); ?>";
var one_month_later = "<?php echo ($one_month_later); ?>";
var max_length = <?php echo ($max_length); ?>;
var time_today = <?php echo ($today_time_json); ?>;
var time_all = <?php echo ($all_time_json); ?>;
//-->
</script>
<div id="footer">
    <div class="container"></div>
</div>
<?php if(!empty($app_source_third_js) ): if(is_array($app_source_third_js)): foreach($app_source_third_js as $key=>$vo): ?><script src="__PUBLIC__/<?php echo ($vo); ?>"></script><?php endforeach; endif; endif; ?>
<?php if(!empty($app_source_js) ): ?><script src="__PUBLIC__/<?php echo ($app_source_path); echo ($app_source_js); ?>"></script><?php endif; ?>
</body>
</html>