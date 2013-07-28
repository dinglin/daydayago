<?php
class PlanModel extends Model {
    const IS_DELETE_NO = 0;
    const IS_DELETE_YES = 1;
    const IS_PUBLIC_SELF = 0;
    const IS_PUBLIC_DOUBLE = 1;
    const IS_PUBLIC_ALL = 2;
    public function do_create($plan_content){
        $plan = $plan_content['plan'];
        $content = $plan_content['content'];
        if($plan && is_array($plan)){
            $plan['isdelete']=0;
            $plan['lastupdate'] = $plan['created']= time();
            if(!isset($plan['ispublic'])){
                $plan['ispublic'] = 0;
            }
            $plan_id = $this->add($plan);
            if($plan_id && $content){
                $content['id'] = $plan_id;
                $PlanContent = M('PlanContent');
                $PlanContent->add($content);
            }
            return $plan_id;
        }
        return false;
    }
    /**
     * 某天的计划
     * @param int $user_id
     * @param date = $date
     */
    public function getTodayPlans($user_id,$date=""){
        $date_start = 0;
        $date_end = 0;
        if($date){
            $date_time = strtotime($date);
            $date_start = mktime(0,0,0,date("m",$date_time),date("d",$date_time),date("Y",$date_time));
            $date_end = mktime(0,0,0,date("m",$date_time),date("d",$date_time)+1,date("Y",$date_time));
        }else{
            $date_start = mktime(0,0,0,date("m"),date("d"),date("Y"));
            $date_end = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
        }
        $data_temp = $this->field(true)->where("tuser_id={$user_id} AND isdelete=0 AND end_date>={$date_start} AND start_date<={$date_start}")->select();
        if(!empty($data_temp)){
            foreach($data_temp as $val){
                $data[$val['id']] = $val;
            }
            $ids=array_keys($data);
            $PlanContent = M('PlanContent');
            $contents = $PlanContent->field(true)->where("id in(".join(",",$ids).")")->select();
            if(!empty($contents)){
                foreach ($contents as $content){
                    $data[$content['id']]['content'] = $content;
                }
            }
        }
        return $data;
    }
    public function getPlan($use_id,$plan_id){//注意查看权限
        if(!$use_id || !$plan_id){
            return array();
        }
        $plan_id = intval($plan_id);
        $plan = $this->where("id={$plan_id} AND isdelete=0")->find();
        if(!empty($plan)){
            $is_right = false;
            if($plan['tuser_id'] == $use_id || $plan['cuser_id'] == $use_id){
                $is_right = true;
            }elseif($plan['ispublic'] == self::IS_PUBLIC_ALL){//公开
                $is_right = true;
            }elseif($plan['ispublic'] == self::IS_PUBLIC_DOUBLE){//两人
               
            }
            if($is_right){
                $PlanContent = M('PlanContent');
                $plan_content = $PlanContent->where("id={$plan_id}")->find();
                $plan['content'] = $plan_content;
                return $plan;
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
}