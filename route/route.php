<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

    Route::get('/','index/Index/index');
    //发送短信接口
    Route::post('sendMobile','web/Login/sendMobileMsg');
    //发送邮件接口
    Route::post('sendEmail','web/Login/sendEmailMsg');
    //所有角色用户登录接口
    Route::post('login','index/Login/login');
