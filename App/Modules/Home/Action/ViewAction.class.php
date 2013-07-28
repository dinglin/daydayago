<?php
// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

class ViewAction extends BaseAction{
    public function index(){
        echo 123123;exit;
        $this->display();
    }

    public function read($id=0){
        $Model  =   D('Form');
        $this->assign('vo',$Model->getDetail($id));
        $this->display();
    }
}