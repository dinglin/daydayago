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

<div id="container-for-buddylist">
    <div id="container">
        <div id="profile_wrapper">
                <div id="timeline_wrapper">
                    <div id="timeline" class="clearfix">
	                    <div class="born" id="born-le">
	                        <div class="timeline_feed tlf_feed">
	                            <section class="tl-a-feed">
	                                <article class="content">
	                                    <div class="content-main">
	                                        <div class="life-event">
	                                           <div class="head_content">
		                                            <div>
		                                              <img src="__PUBLIC__/Images/static/noheadpic.jpg">
		                                              <a class="btn">关注</a>
		                                            </div>
		                                            <div>
		                                              <a class="btn">关注</a>
		                                              <img src="__PUBLIC__/Images/static/noheadpic.jpg">
		                                            </div>
	                                            </div>
	                                            <div class="clear:both;"></div>
	                                            <p class="event-info">description</p>
	                                        </div>
	                                    </div>
	                                </article>
	                            </section>
	                        </div>
	                    </div>
                        <div class="timeline_marker timeline_marker_top" data-time="2013-6">
                            <span class="dda_date">
                                <span class="dda_date_day"><?php echo ($day); ?></span>
                                <span class="dda_date_mon"><?php echo ($month); ?></span>
                            </span>
                        </div>
                        <section>
                        <?php if(is_array($plans)): $i = 0; $__LIST__ = $plans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="timeline_feed <?php echo ($key%2==1?'tll_feed':'tlr_feed'); ?>">
                                <section id="newsfeed-22455690119"
                                    class="tl-a-feed  tl-new-feed" style="display: block;">
                                    <article class="share-feed">
                                        <div class="content-source">
                                            <aside>
                                                   <div class="main-text main-title">
                                                   <a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a>
                                                   </div>
                                                   <div class="main-text main-content"><?php echo ($vo["content"]["content"]); ?></div>
                                            </aside>
                                        </div>
                                        <div class="tl-share-time dda_plan_times"><?php echo ($vo["start_date"]); ?> ~ <?php echo ($vo["end_date"]); ?></div>
                                    </article>
                                    <div class="legend">
                                        <span class="type">考评</span><a data-fid="22455690119"
                                            href="http://www.daydayago.com/370508541/profile?portal=homeFootprint&ref=home_footprint#nogo"
                                            onclick="return false;" class="replied"> 回复(2)</a> <a
                                            class="shared share_new" onclick="return false;"
                                            href="http://www.daydayago.com/370508541/profile?portal=homeFootprint&ref=home_footprint#nogo"
                                            data-share="{stype:&#39;create_share_div&#39;,id:15814690979,owner:370508541,host:0,ref:&#39;feed&#39;,from:&#39;0101010403&#39; }">分享</a><a
                                            data-ilike="{type:&#39;share&#39;, id:15814690979, owner:370508541, mid:259792302, mname:&#39;丁林&#39;}"
                                            data-ilikeid="share_15814690979"
                                            href="http://www.daydayago.com/370508541/profile?portal=homeFootprint&ref=home_footprint#nogo"
                                            onclick="return false;" class="ilike-button like">赞</a>
                                    </div>
                                </section>
                                <i></i>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </section>
                        <?php if(!empty($plans) ): ?><div class="timeline_marker timeline_marker_bottom" data-time="2013-6">
                            <span class="dda_date">
                                <span class="dda_date_day"><?php echo ($day); ?></span>
                                <span class="dda_date_mon"><?php echo ($month); ?></span>
                            </span>
                        </div><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer">
    <div class="container"></div>
</div>
<?php if(!empty($app_source_third_js) ): if(is_array($app_source_third_js)): foreach($app_source_third_js as $key=>$vo): ?><script src="__PUBLIC__/<?php echo ($vo); ?>"></script><?php endforeach; endif; endif; ?>
<?php if(!empty($app_source_js) ): ?><script src="__PUBLIC__/<?php echo ($app_source_path); echo ($app_source_js); ?>"></script><?php endif; ?>
</body>
</html>