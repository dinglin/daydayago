<?php
class ErrorAction extends Action {
    
    protected $public_header_source = "Home/Public/index";
    
    public function index(){
        
        $this->set_source();
        
        $this->set_head_info();
        
        $this->set_url();
        
        $this->display();
    }
    protected function set_url(){
        
    }
    protected function set_source(){
        //资源文件路径
        $this->app_source_path= strtolower(APP_NAME."/");
        $this->app_source_css = base64_encode($this->public_header_source).".".css;
         //第三方
        $this->app_source_third_css = $this->set_third_css();
    }
    protected function set_third_css(){
        return array(
                "bootstrap/css/bootstrap.min.css",
        );
    }
    /**
     * 头部信息
     */
    protected function set_head_info(){
        $this->html_head_title = WEB_NAME." 404";
    }
}