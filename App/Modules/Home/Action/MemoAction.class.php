<?php
/**
 * 备忘录
 * 可提醒，可不提醒
 * 重要程度
 * @author dinglin
 *
 */
class MemoAction extends BaseAction{
    
    const WARN_TIME = 3600;//1小时
    const COLOR_GRAY = "#999999";
    const COLOR_RED  = "#EC302F";
    const COLOR_YELLOW = "#F7EC20";
    const COLOR_BLACK = "#000000";
    const WARN_NO = 0;//还没有提醒
    const WARN_NO_NEED=2;//不需要提醒
    const WARN_YES = 1;//已提醒
    const MAX_CONTENT_LENGTH = 100;//100字
    public function index(){
        if($this->is_post()){
            $this->create();
        }
        
        $model_memo = D('Memo');
        $this->memos = $model_memo->getTodayMemos($this->get_user_id());
        $this->search_date = isset($_GET['date'])?strtotime($_GET['date']):strtotime(date('Y-m-d'));
        $this->_do_memos_color();
        $this->_do_memos_sort();
        $this->_set_data();
        $this->display();
    }
    public function create(){
        $content = $this->get_post_param("memo");
        if(empty($content)){ 
            $this->error_msg = "请填写备忘录";
        }
        if(utf8_strlen($content)>self::MAX_CONTENT_LENGTH){
            $this->error_msg = "备忘录长度超出".self::MAX_CONTENT_LENGTH."字";
        }
        if(!$this->error_msg){
            $warn_time = 0;
            $time = $this->get_post_param("time");
            $is_larger = $this->get_post_param("is_larger");
            $weight = $this->get_post_param("weight","int");
            $ispublic = $this->get_post_param("is_public","int");
            if($is_larger){
                $start_date = $temp_start = $this->get_post_param("date_start");
                if($start_date){
                    $start_date = strtotime($start_date);
                }else{
                    $start_date = 0;
                }
                $end_date = $this->get_post_param("date_end");
                if($end_date){
                    $end_date = strtotime($end_date);
                }else{
                    $end_date = 0;
                }
                if($time){
                    $iswarm = self::WARN_NO_NEED;
                    if($start_date){
                        $warn_time = $temp_start." ".$time.":00";
                    }elseif($end_date){
                        $warn_time = $end_date." ".$time.":00";
                    }else{
                        $warn_time = date('Y-m-d')." ".$time.":00";//今天时间
                    }
                    $warn_time = strtotime($warn_time);
                }else{
                    $iswarm = self::WARN_NO;
                    $warn_time =time();
                }     
                $data = array(
                        "cuser_id"=>$this->get_user_id(),
                        "tuser_id"=>$this->get_user_id(),
                        "content"=>$content,
                        "warn_time"=>$warn_time,
                        "iswarn"=>$iswarm,
                        "start_date"=>$start_date,
                        "end_date"=>$end_date,
                        "weight"=>$weight,
                        "ispublic"=>$ispublic
                );
            }else{
                $iswarm = self::WARN_NO;
                $warn_time = time();//可以根据提醒时间查出
                $data = array(
                        "cuser_id"=>$this->get_user_id(),
                        "tuser_id"=>$this->get_user_id(),
                        "content"=>$content,
                        "warn_time"=>$warn_time,
                        "iswarn"=>$iswarm
                );
            }
           
            $model_memo = D('Memo');
            return $model_memo->do_create($data);
        }else{
            return false;
        }
    }
    public function do_delete(){
        
    }
    public function do_public(){
        
    }
    protected function set_head_title(){
        return "备忘录";
    }
    /**
     * 颜色提醒
     */
    private function _do_memos_color(){
        if($this->memos){
            $memos = $this->memos;
            $now_time = time();
            $now_day_time = strtotime(date("Y-m-d"));
            foreach($memos as &$memo){
                $memo['time'] = date("H:i",$memo['warn_time']);
                if($this->search_date == $now_day_time){
                    if($memo['iswarn'] == self::WARN_NO){//还未提醒的
                        if($memo['warn_time'] >= $now_time && (($memo['warn_time']-$now_time) <= self::WARN_TIME)){//1小时内黄色提醒
                            $memo['text_color'] = self::COLOR_YELLOW;
                        }elseif($memo['warn_time'] > $now_time ){//未到提醒时间
                            $memo['text_color'] = self::COLOR_BLACK;
                        }elseif($memo['warn_time'] < $now_time ){//已过提醒时间
                            $memo['text_color'] = self::COLOR_RED;
                        }
                    }elseif($memo['iswarn'] == self::WARN_NO_NEED){//不需要提醒
                        $memo['text_color'] = self::COLOR_BLACK;
                    }elseif($memo['iswarn'] == self::WARN_YES){//已经提醒过
                        $memo['text_color'] = self::COLOR_GRAY;
                    }
                    $memo['day_type'] = "1";
                }elseif($this->search_date > $now_day_time){//未来
                    $memo['day_type'] = "2";
                    $memo['text_color'] = self::COLOR_BLACK;
                }else{//历史
                    $memo['text_color'] = self::COLOR_GRAY;
                    $memo['day_type'] = "0";
                }
                $memo['content'] = htmlspecialchars($memo['content']);
                $memo['content_smail'] = utf8_substr($memo['content'], 0, 35);
            }
            $this->memos = $memos;
        }
    }
    /**
     * 权重+颜色排序
     */
    private function _do_memos_sort(){
        if($this->memos){
            $memos = $this->memos;
            //权重排序
            $temp = array();
            foreach($memos as $memo){
               $temp[$memo['weight']][] = $memo;
            }
            krsort($temp);
            $temp = $this->_get_array($temp);
            //颜色排序
            $memos = array();
            foreach($temp as $memo){
                if($memo['text_color'] == self::COLOR_YELLOW){
                    $memos[0][] = $memo;
                }elseif($memo['text_color'] == self::COLOR_BLACK){
                    $memos[2][] = $memo;
                }elseif($memo['text_color'] == self::COLOR_RED){
                    $memos[1][] = $memo;
                }elseif($memo['text_color'] == self::COLOR_GRAY){
                    $memos[3][] = $memo;
                }
            }
            ksort($memos);
            $memos = $this->_get_array($memos);
            //状态排序
            $temp = array();
            foreach($memos as $memo){
                if($memo['iswarn'] == self::WARN_NO){
                    $temp[0][] = $memo;
                }elseif($memo['iswarn'] == self::WARN_YES){
                    $temp[2][] = $memo;
                }elseif($memo['iswarn'] == self::WARN_NO_NEED){
                    $temp[1][] = $memo;
                }
            }
            ksort($temp);
            $temp = $this->_get_array($temp);
            $this->memos = $temp;
        }
    }
    private function _get_array($array){
        if(empty($array)){
            return array();
        }
        $temp = array();
        foreach($array as $val){
            foreach($val as $v){
                $temp[] = $v;
            }
        }
        return $temp;
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
        ));
    }
    protected function set_third_js(){
        $css = parent::set_third_js();
        return array_merge($css,array(
                "Js/Jquery/jquery.ui.js",
        ));
    }
}