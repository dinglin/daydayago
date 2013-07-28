<?php
/**
 * 计划
 * @author dinglin
 *
 */
class PlanAction extends BaseAction{
    const MAX_CONTENT_LENGTH = 30;//100字
    public function index(){
        if($this->is_post()){
            $this->_add_plan();
        }
        $this->_set_data();
        $this->display();
    }
    public function view(){
        $id = $_GET['id'];
        if($id ){
            $model_plan = D('Plan');
            $this->plan = $model_plan->getPlan($this->get_user_id(),$id);
            $this->set_action_head_info();
            $this->display();
        }else{
            _404("没有该计划","/plan");
        }
    }
    
    private function _add_plan(){
        $title = $this->get_post_param('title');
        $content = $this->get_post_param('detail');
        $start_date = $this->get_post_param('date_start');
        $end_date = $this->get_post_param('date_end');
        $ispublic = $this->get_post_param('is_public',"int");
        $plan = array(
                "cuser_id"=>$this->get_user_id(),
                "tuser_id"=>$this->get_user_id(),
                "title"=>$title,
                "start_date"=>strtotime($start_date),
                "end_date"=>strtotime($end_date),
                "ispublic"=>$ispublic
        );
        $content = array("content"=>$content);
        $model_plan = D('Plan');
        $data = array('plan'=>$plan,'content'=>$content);
        return $model_plan->do_create($data);
    }
    private function _set_data(){
    
        $this->date = $this->get_today_time();
        $this->today_time_json = json_encode($this->date);
        $this->all_time_json = json_encode($this->get_all_time());
        $this->today = date('Y-m-d');
        $this->tomorrow = date('Y-m-d',strtotime('+1 day'));
        $this->one_month_later = date('Y-m-d',strtotime('+1 month'));
        $this->max_length = 2*self::MAX_CONTENT_LENGTH;//100字
    }
    private function get_all_time(){
        $all_date = array();
        $all_date[] = array('key'=>"提醒时间","val"=>"");
        $all_date[] = array('key'=>"AM","val"=>"AM");
        for($i=1;$i<=12;$i++){
            if($i<10){
                $all_date[] = array('key'=>"0".$i.":00","val"=>"0".$i.":00");
            }else{
                $all_date[] = array('key'=>$i.":00","val"=>$i.":00");
            }
        }
        $all_date[] = array('key'=>"PM","val"=>"PM");
        for($i=13;$i<=24;$i++){
            $all_date[] = array('key'=>$i.":00","val"=>$i.":00");
        }
        return $all_date;
    }
    private function get_today_time(){
        $now_hour = date('H');
        $date = array();
        $date[] = array('key'=>"提醒时间","val"=>"");
        if($now_hour <=12 ){
            $date[] = array('key'=>"AM","val"=>"AM");
            for($i=$now_hour+1;$i<=12;$i++){
                if($i<10){
                    $date[] = array('key'=>"0".$i.":00","val"=>"0".$i.":00");
                }else{
                    $date[] = array('key'=>$i.":00","val"=>$i.":00");
                }
            }
            $now_hour = 12;
        }
        $date[] = array('key'=>"PM","val"=>"PM");
        for($i=$now_hour+1;$i<=23;$i++){
            $date[] = array('key'=>$i.":00","val"=>$i.":00");
        }
        if($now_hour ==23){
            $date[] = array('key'=>"向深夜还在奋斗的同学致敬!","val"=>"24:00");
        }
        return $date;
    }
    protected function set_third_css(){
        $css = parent::set_third_css();
        return array_merge($css,array(
                "Js/Jquery/jquery.ui.css",
                "Js/kindeditor/themes/default/default.css"
        ));
    }
    protected function set_third_js(){
        $css = parent::set_third_js();
        return array_merge($css,array(
                "Js/Jquery/jquery.ui.js",
                "Js/kindeditor/kindeditor-min.js",
                "Js/kindeditor/lang/zh_CN.js"
        ));
    }
    protected function set_head_title(){
        return "计划";
    }
    private function set_action_head_info(){
        if(ACTION_NAME == "view"){
            $this->set_action_title($this->plan['title']);
        }
    }
}