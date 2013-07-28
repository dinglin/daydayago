<?php
/**
 * 个人主页
 * @author dinglin
 *
 */
class HomeAction extends BaseAction{
    public function index(){
        $this->set_data();
        
        $plan_model = D("Plan");
        $this->plans = $plan_model->getTodayPlans($this->get_user_id());
        $this->build_data();
        $this->display();
    }
    public function set_data(){
        $this->month = date("Y年m月");
        $this->day = date('d');
    }
    public function build_data(){
        if(!empty($this->plans)){
            $plans = $this->plans;
            foreach($plans as &$plan){
                $plan['start_date'] = date('Y-m-d',$plan['start_date']);
                $plan['end_date'] = date('Y-m-d',$plan['end_date']);
                $plan['content']['content'] = utf8_substr($plan['content']['content'], 0, 100);
                $plan['url'] = $this->myurl->plan_view($plan['id']);
            }
            $this->plans = $plans;
        }
    }
}