<?php
class MemoModel extends Model {
    /**
     * 今天的备忘录
     * @param int $user_id
     * @param date = $date
     */
    public function getTodayMemos($user_id,$date=""){
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
        $data1 = $this->field(true)->where("tuser_id={$user_id} AND isdelete=0 AND warn_time>={$date_start} AND warn_time<{$date_end}")->select();
        $data2 = $this->field(true)->where("tuser_id={$user_id} AND isdelete=0 AND end_date>={$date_start} AND start_date<={$date_start}")->select();
        if(!empty($data1) && !empty($data2)){
            $data_temp = array_merge($data1,$data2);
        }elseif(!empty($data1)){
            $data_temp = $data1;
        }else{
            $data_temp = $data2;
        }
        $data = array();
        foreach($data_temp as $val){
            $data[$val['id']] = $val;
        }
        return $data;
    }
    public function do_create($memo){
        if($memo && is_array($memo)){
            $memo['isdelete']=0;
            $memo['lastupdate'] = $memo['created']= time();
            if(!isset($memo['ispublic'])){
                $memo['ispublic'] = 0;
            }
            return $this->add($memo);
        }
        return false;
    }

    /**
     * 创建人可以删除
     * @param int $user_id
     * @param int $id
     * @return boolean
     */
    public function do_delete($user_id,$id){
        if($user_id && $id && is_numeric($user_id) && is_numeric($id)){
            return $this->where("cuser_id={$user_id} AND id={$id}")->setField("isdelete",1);
        }
        return false;
    }
    /**
     * 创建人可以选择公开
     * @param int $public
     * @return boolean
     */
    public function do_public($user_id,$id,$public){
        if($user_id && $id && is_numeric($user_id) && is_numeric($id)){
            return $this->where("cuser_id={$user_id} AND id={$id}")->setField("ispublic",$public);
        }
        return false;
    }
}