<?php
/**
 * index
 * @author dinglin
 */

class IndexAction extends BaseAction{
 

    function _initialize() {
        $this->myurl = D('MyUrl');
        if($this->is_login()){
            redirect($this->myurl->home_index());
        }
        $this->set_source();
        $this->set_head_info();
    } 
    public function index(){
        $this->index_login_url = $this->myurl->index_login_post();
        $this->index_register_url = $this->myurl->index_register_post();
        $this->display();
    }
    public function login(){
        if($this->is_post()){
            $mail = $this->get_post_param("user-mail");
            $pwd = $this->get_post_param("user-pwd");
            $res_mail = $this->_check_mail($mail);
            $res_pwd = $this->_check_pwd($pwd);
            if($res_mail && $res_pwd){
                $Model = D("Member");
                $member = $Model->getUserByMail($mail);
                if($member && md5($pwd) == $member['u_pwd']){
                    $this->set_login($member);
                    redirect($this->myurl->home_index());
                }
            }
        }
        redirect("/");
    }
    public function tologout(){
        $this->logout();
        redirect("/");
    }
    public function regist(){
        
    }
    public function test(){
     $this->display();
    }
    
    
    /**
     * 验证form提交的mail
     * @param string $mail
     * @return boolean
     */
    private function _check_mail($mail){
        if(empty($mail)){
             return false;
        }
        $reg = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]w+)*$/';
        if(!preg_match($reg,$mail)){
             return false;
        }
        return true;
    }
    /**
     * 验证form提交的密码
     * @param unknown $pwd
     * @return boolean
     */
    private function _check_pwd($pwd){
        if(empty($pwd)){
            return false;
        }
        $len = strlen($pwd);
        if($len<6 || $len>16){
            return false;
        }
        return true;
    }
}