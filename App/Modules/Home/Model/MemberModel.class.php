<?php
class MemberModel extends Model {
    public function getList($count=5){
        return $this->order('id DESC')->field(true)->limit($count)->select();
    }

    public function getUserByMail($mail){
        $result = array();
        if(!$mail){
             return $result;
        }
        return $this->where("u_mail='{$mail}'")->find();
    }
    public function get_user_by_uid($uid){
     $result = array();
     if(!$uid || !is_numeric($uid)){
         return $result;
     }
     return $this->where("id='{$uid}'")->find();
    }
}