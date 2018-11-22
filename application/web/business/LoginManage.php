<?php
namespace app\web\business;

use think\facade\Cache;
use tencentMessage;
use aliyunMessage;
use think\facade\Log;

Class LoginManage
{
    protected $foo;
    protected $str;
    public function __construct()
    {
      //定义空的数组对象
      $this->foo = (object)array();
      //定义空字符串
      $this->str = '';
    }
    /**
     * 登陆发送腾讯短信
     * @Author laravelchen
     * @DateTime 2018-11-22
     * @param    [string]     mobile    必填手机号
     * @param    [string]     prophone  选填区域号
     * @return   array();
     */
    public function sendTencentMobileMsg($mobile,$prophone)
    {
       //这里应该用validate去验证的
       if(empty($mobile))
       {
          return return_format($this->str,10000,lang(10000));
       }
       if(empty($prophone)) $prophone = '86';
       if(strlen($mobile)< 6 || strlen($mobile)> 11 || !is_numeric(rtrim($mobile)))
       {
          return return_format($this->str,10001,lang(10001));
       }else{
         //删除对应的手机号缓存
          Cache::rm('mobile'.$mobile);
         //随机验证码
         $mobile_code = rand(100000,999999);
         //调用短信接口，发送验证码
         $mobileObj   = new tencentMessage;
         $send_result = $mobileObj->sendMobileMsg($mobile,$type=4,$params=[$mobile_code],$prophone);
         if($send_result['result'] == 0)
         {
             return return_format('',0,lang('success'));
         }else{
             Log::write('发送验证码错误号:'.$send_result['result'].'发送验证码错误消息:'.$send_result['errmsg']);
         }
       }
    }
    /**
     * 登陆发送阿里云短信
     * @Author laravelchen
     * @DateTime 2018-11-22
     * @param    [string]     mobile    必填手机号
     * @param    [string]     prophone  选填区域号
     * @return   array()
     */
    public function sendAliyunMobileMsg($mobile,$prophone)
    {
      if(empty($mobile))
      {
         return return_format($this->str,10000,lang(10000));
      }
      if(empty($prophone)) $prophone = '86';
      if(strlen($mobile)< 6 || strlen($mobile)> 11 || !is_numeric(rtrim($mobile)))
      {
         return return_format($this->str,10001,lang(10001));
      }else{
        //删除对应的手机号缓存
         Cache::rm('mobile'.$mobile);
        //随机验证码
        $mobile_code = rand(100000,999999);
        //调用短信接口，发送验证码
        $mobileObj   = new aliyunMessage;
        $send_result = $mobileObj->sendSms($mobile,$mobile_code);
        if($send_result['Code'] == 'OK')
        {
            return return_format('',0,lang('success'));
        }else{
            Log::write('发送验证码错误号:'.$send_result['Code'].'发送验证码错误消息:'.$send_result['Message']);
        }
      }
    }

}
