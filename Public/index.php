<?php
/**
 * js css 压缩
 * 控制js css img输出hear cache-controll
 */
$one_day = 86400;

$uri_arr = explode(".",$dda_uri);

$suffix = end($uri_arr);//文件类型

require './Public/config.php';//content-type

if(!isset($mimetypes[$suffix])){//没有找到文件类型
    echo_empty();
}

$uri_arr = explode("/",$dda_uri);
if(count($uri_arr) <=2){
    echo_empty();
}
if( $uri_arr[2] == "app" && ( $suffix=="js" || $suffix=="css" ) ){//合并js/css
    if(isset($uri_arr[3])){
        $uri_arr = explode("/",$current_uri);
        $files_arr = explode(".",$uri_arr[3]);
        if($files_arr[0] && $files_arr[1] && $suffix==$files_arr[1]){
            header("Content-Type: ".$mimetypes[$suffix]);//设置文件类型
            if(!APP_DEBUG){
                header("Cache-Control: max-age=".($one_day*30));//30天
            }
            $files_str = base64_decode($files_arr[0]);
            $files = explode("&",$files_str);
            foreach($files as $file){
                $file_path = "./Public/".APP_NAME."/".$file.".".$suffix;
                if(file_exists($file_path)){
                    echo file_get_contents($file_path);
                }
            }
            exit();
            /*
            ob_start();
            ob_get_contents() ;
            ob_end_clean();
            */
        }
    }
    echo_empty();
}else{
    $file = ".".$current_uri;
    if(file_exists($file)){
        header("Content-Type: ".$mimetypes[$suffix]);//设置文件类型
        if(!APP_DEBUG){
            header("Cache-Control: max-age=".($one_day*30));//30天
        }        
        echo file_get_contents($file);
        exit();
    }else{
        echo_empty();
    }
}

/**
 * 输出为空
 */
function echo_empty(){
    header("Content-Type: text/plain");
    header("Cache-Control: max-age=".($one_day*30));//30天
    die("");
}