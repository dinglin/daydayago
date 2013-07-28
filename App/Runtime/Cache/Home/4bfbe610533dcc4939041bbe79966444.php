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
                <li class="active"><a href="#home" data-toggle="tab">我的备忘录</a></li>
                <li><a href="#home" data-toggle="tab">给XXX的备忘录</a></li>
            </ul>
       </div>
       <div class="span9">
                <div class="span10" id="input_memo_set_hide">
                    <form action="" method="post" id="memo_form" class="form-horizontal">
                         <div class="control-group" id="error_control_input_memo">
                            <div class="controls">
                               <textarea name="memo" id="memo_content" class="dda_memo_content" placeholder="今天的备忘录"  onkeydown="forbiddance_paste(event)" onpaste="return false" oncontextmenu = "return false;"></textarea>
                               <span class="help-inline" ><b><span id="memo_content_length"><?php echo ($max_length/2); ?></span></b>字</span>
                            </div>
                         </div>
                         <div id="input_memo_set" style="display:none;">
                           <div class="control-group">
                               <div class="controls">
                                   <select name="time" id="notice_time" class="span2 dda_input_default_color">
                                      <?php if(is_array($date)): $i = 0; $__LIST__ = $date;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["val"] == 'AM' || $vo["val"] == 'PM' ): ?><optgroup label="<?php echo ($vo["val"]); ?>"><?php echo ($vo["key"]); ?></optgroup>
                                      <?php else: ?>
                                      <option value="<?php echo ($vo["val"]); ?>"><?php echo ($vo["key"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                   </select>
                                   &nbsp;&nbsp;&nbsp;&nbsp;
                                   <i class="icon-time"></i>
                                   <span class="help-inline dda_info_text" id="info_time_notice"></span>
                                   <span class="help-inline dda_error_text" id="error_time_notice"></span>
                               </div>
                               <div class="controls controls-row">
                                       <input type="text" id="date_start" name="date_start" placeholder="开始日期"/> 
                                       <input type="text"  id="date_end" name="date_end" placeholder="结束日期"/>
                               </div>
                           </div>
                           <div class="control-group">
                               <div id="radio_weight" class="ui-buttonset controls">
                                    <input type="radio" name="weight" id="radio1" class="ui-helper-hidden-accessible" value="0" checked="checked">
                                    <label for="radio1" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-state-active" role="button" aria-disabled="false" aria-pressed="true">
                                        <span class="ui-button-text">普通</span>
                                    </label>
                                    <input type="radio" name="weight" id="radio2" class="ui-helper-hidden-accessible" value="1">
                                    <label for="radio2" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false" aria-pressed="false">
                                        <span class="ui-button-text">重要</span>
                                    </label>
                                    <input type="radio" name="weight" id="radio3" class="ui-helper-hidden-accessible" value="2">
                                    <label for="radio3" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false" aria-pressed="false">
                                        <span class="ui-button-text">特别重要</span>
                                    </label>
                               </div>
                            </div>
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
                <?php if(!empty($memos) ): ?><div class="span4"><a href="#"><i class="icon-arrow-left"></i>前一天</a>   <a href="#">后一天<i class="icon-arrow-right"></i></a></div>
                    <table class="table table-hover dda_t_bg_color">
                    <tbody>
                        <?php if(is_array($memos)): $i = 0; $__LIST__ = $memos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr style="color:<?php echo ($vo["text_color"]); ?>;">
                            <td width=""><?php echo ($vo["content_smail"]); ?></td>
                            <td width="27%">
	                            <?php if(!$vo["iswarn"] == '2' ): ?><button class="btn btn-large dda_clock_size">
	                            <i class="clock_num clock_num_<?php echo ($vo["time"]["0"]); ?>"></i><i class="clock_num clock_num_<?php echo ($vo["time"]["1"]); ?>"></i> : 
	                            <i class="clock_num clock_num_<?php echo ($vo["time"]["3"]); ?>"></i><i class="clock_num clock_num_<?php echo ($vo["time"]["4"]); ?>"></i>
	                            </button><?php endif; ?> 
                            </td>
                            <td width="20%">
                                <span class="label">
                                <?php if(!$vo["ispublic"] ): ?>私密
                                <?php elseif($vo["ispublic"] == '2' ): ?>公开<?php endif; ?>
                                </span>&nbsp;&nbsp;
                                <?php if(!$vo["iswarn"] ): ?><a href="#myModal" data-toggle="modal">好的，知道了</a><?php endif; ?>
                            </td>
                            <td width="10%">
                                <?php if($vo["iswarn"] != '1' ): ?><div class="dropdown dropup">
                                     <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">设置
                                         <span class="caret"></span>
                                     </a>
                                     <ul class="dropdown-menu"  role="menu" aria-labelledby="dLabel">
                                         <li class="dropdown-submenu pull-left">
                                             <a><i class="icon-eye-open"></i>  公开</a>
                                             <ul class="dropdown-menu">
                                                 <li><a href="tabindex" tabindex="-1">个人</a></li>
                                                 <li><a href="tabindex" tabindex="-1">与她</a></li>
                                                 <li><a href="tabindex" tabindex="-1">所有</a></li>
                                             </ul>
                                         </li>
                                         <li><a href="tabindex" tabindex="-1"><i class="icon-trash"></i>  删除</a></li>
                                         <li><a href="tabindex" tabindex="-1"><i class="icon-edit"></i>  高级</a></li>
                                     </ul>
                                 </div><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                    </table><?php endif; ?>
            </div>
     </div>
</div>
<<script type="text/javascript">
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