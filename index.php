<?php
/*
 * Created on 2013-5-28
 * @author dinlin
 */
 //开启调试模式
 define('APP_DEBUG', true);
 //版本号
 define('VERSION', '20130615');

 define('BASE_DOMAIN',"http://daydayago.com");
 define('WEB_NAME',"天天向上");
 
 define('APP_NAME', 'App');
 define('APP_PATH', './App/');

 //入口文件
 $dda_uri = $current_uri = $_SERVER['REQUEST_URI'];
 $dda_uri = strtolower( $dda_uri );
 if(strlen($dda_uri)>=7 && substr($dda_uri,1,6) == "public"){//source
     require './Public/index.php';
 }else{//app
     require './ThinkPHP/ThinkPHP.php';
 }
?>
