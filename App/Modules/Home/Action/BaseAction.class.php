<?php

class BaseAction extends Action {

    protected $myurl;
    protected $public_header_source = "Home/Public/index";
    function _initialize() {
        //验证登陆
        if(!$this->is_login()) {
            redirect('/');
        }
        $this->set_source();
        
        $this->set_head_info();
        
        $this->set_url();
        
    }
    protected function set_url(){
        $this->myurl = D('MyUrl');
        $this->lougout_url = $this->myurl->index_logout();
        $this->memo_url = $this->myurl->memo_index();
        $this->plan_url = $this->myurl->plan_index();
        $this->active = $this->myurl->active();
    }
    /**
     * js、css资源文件
     */
    protected function set_source(){
        //资源文件路径
        $this->app_source_path= strtolower(APP_NAME."/");
        //设置样式
        $this->app_source_css = $this->_get_base_64_source_url($this->set_css(),'css');
        //设置脚本
        $this->app_source_js = $this->_get_base_64_source_url($this->set_js(),'js');
        //第三方
        $this->app_source_third_css = $this->set_third_css();
        $this->app_source_third_js = $this->set_third_js();
    }
    private function _get_base_64_source_url($source,$suffix){
        $source_64 = "";
        $base_path = C('DEFAULT_GROUP')."/".MODULE_NAME."/";
        if($source){
            if(is_array($source)){
                $app_css = array();
                foreach($source as $cs){
                    $c = explode(".",$cs);
                    array_pop($c);
                    $app_css[] = $base_path.implode(".",$c);
                }
                $app_css[] = $this->public_header_source;
                $source_64 = implode("&",$app_css);
            }else{
                $c = explode(".",$source);
                array_pop($c);
                $source_64 = $base_path.implode(".",$c);
                $source_64 .= "&".$this->public_header_source;
            }
            $source_64 = base64_encode($source_64).".".$suffix;
        }
        return $source_64;
    }
    /**
     * 头部信息
     */
    protected function set_head_info(){
        $title = $this->set_head_title();
        $this->html_head_title = $title?$title." | ".WEB_NAME:WEB_NAME;
        $this->html_head_keywords = $this->set_head_keywords().",".WEB_NAME;
        $this->html_head_description = $this->set_head_description().",".WEB_NAME;
    }
    protected function set_head_title(){
        return "";
    }
    protected function set_action_title($title){
        $this->html_head_title = $title?$title." | ".WEB_NAME:WEB_NAME;
    }
    protected function set_head_keywords(){
        return "";
    }
    protected function set_action_head_keywords($keywords){
        $this->html_head_title = $keywords?$keywords.",".WEB_NAME:WEB_NAME;
    }
    protected function set_head_description(){
        return "";
    }
    protected function set_action_head_description($description){
        $this->html_head_title = $description?$description.",".WEB_NAME:WEB_NAME;
    }
    /**
     * 设置页面调用的样式
     * @param array $css_arr
     */
    protected function set_css(){//
        return array(ACTION_NAME.".css");
    }
    protected function set_third_css(){
        return array(
                "bootstrap/css/bootstrap.min.css",
        );
    }
    protected function set_js(){//ACTION_NAME
        return array(ACTION_NAME.".js");
    }
    protected function set_third_js(){
        return array(
                "Js/Jquery/jquery.1.9.1.js",
                "bootstrap/js/bootstrap.min.js"
        );
    }
    // 用户登出
    protected function logout() {
        if(isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_mail']);
            unset($_SESSION);
            session_destroy();
            //setcookie('uinfo', base64_encode($cookie), time()-604800);//cookie 7天
            $this->success('登出成功！','/');
         }else {
            $this->error('已经登出！');
        }
    }
    /**
     * 检查登录
     * @return boolean
     */
    protected  function is_login(){
        if(isset($_SESSION['user_id'])){
             return true;
        }elseif(isset($_COOKIE['uinfo'])){
             $Model = D("Member");
             $temp_uinfo = base64_decode($_COOKIE['uinfo']);
             $temp_arr = explode("&",$temp_uinfo);
             $uinfo = array();
             foreach($temp_arr as $val){
                 $temp = explode("=",$val);
                 $uinfo[$temp[0]] = $temp[1];
             }
             $member = $Model->get_user_by_uid($uinfo['uid']);
             $this->set_login($member);
             return true;
         }
         return false;
    }
    protected function get_user_id(){
        return  $_SESSION['user_id']; 
    }
    protected function get_user_name(){
        return $_SESSION['user_name'];
    }
    protected function get_user_mail(){
        return $_SESSION['user_mail'];
    }
    protected function get_user_ip(){
        return get_client_ip();
    }
    /**
     * 设置登录
     * @param array $member
     */
    protected function set_login($member){
        $_SESSION['user_id'] = $member['id'];
        $_SESSION['user_name']=$member['u_name'];
        $_SESSION['user_mail']=$member['u_mail'];
      
        $cookie = "uid={$member['id']}&uname={$member['u_name']}";
        setcookie('uinfo', base64_encode($cookie), time()+604800);//cookie 7天
    }
    protected function get_post_param($name,$type="string"){
        if(isset($_POST[$name])){
            $val = trim($_POST[$name]);
            if($type == "int"){
                $val = intval($val);
            }elseif($type == "boolean"){
                $val = $val?true:false;
            }
            return $val;
        }else{
            $val = "";
            if($type == "int"){
                $val = 0;
            }elseif($type == "boolean"){
                $val = false;
            }
            return $val;
        }
    }
    protected function is_post(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return true;
        }
        return false;
    }
}