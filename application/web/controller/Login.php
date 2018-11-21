<?php
namespace app\web\controller;


use app\web\business\WebLoginManage;
use think\Controller;

Class Login extends  Controller
{
    /**
     * 登陆发送短信
     * @Author laravelchen
     * @DateTime 2018-11-20
     * @param    [string]     mobile    必填手机号
     * @param    [string]     prophone  选填区域号
     * @return   array();
     * URL:/web/login/
     */
    public function sendMobileMsg()
    {
        $mobile   = $this->request->param('mobile');
        $prophone = $this->request->param('prophone');
        $userobj  = new  WebLoginManage();
        $result   = $userobj->sendMobileMsg($mobile,$prophone);
        $this->ajaxReturn($result);
    }
}
