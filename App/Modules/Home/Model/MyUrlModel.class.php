<?php
/**
 * 地址需遵循Conf/routers.php的规则
 * @author dinglin
 */
class MyUrlModel {
    
    public static function base_uri(){
        return BASE_DOMAIN;
    }
    /**
     * header
     */
    public static function active(){
        $active = "index";
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri,"memo")>0){
            $active = "memo";
        }elseif(strpos($uri,"plan")>0){
            $active = "plan";
        }
        return $active;
    }
    /**
     * 登陆
     */
    public function index_login_post(){
        return self::base_uri()."/post/login";
    }
    /**
     * 注册
     */
    public function index_register_post(){
        return self::base_uri()."/post/register";
    }
    /**
     * 个人主页
     */
    public function home_index(){
        return self::base_uri()."/home";
    }
    /**
     * 退出
     */
    public function index_logout(){
        return self::base_uri()."/logout";
    }
    public function memo_index($date=""){
        if($date){
            $date = "/".$date;
        }
        return self::base_uri()."/memo".$date;
    }
    public function plan_index(){
        return self::base_uri()."/plan";
    }
    public function plan_view($id){
        return self::base_uri()."/plan/".$id;
    }
}