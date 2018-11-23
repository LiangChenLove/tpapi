<?php
namespace app\index\controller;

use think\Controller;
use app\index\business\UserLoginManage;
use think\facade\Request;

class Login extends Controller
{
    //自动以初始化
    protected function _initialize()
    {
      header('Access-Control-Allow-Headers:x-requested-with,content-type,starttime,sign,token,lang');
      //防止跨域
      header('Access-Control-Allow-Origin:*');
    }

    public function login()
    {
       $data     = Request::post(false);
       $loginObj = new UserLoginManage;
       $result   = $loginObj->login($data);
       $this->ajaxReturn($result);
    }
}
