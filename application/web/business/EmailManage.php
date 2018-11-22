<?php
namespace app\web\business;

use think\facade\Cache;
use think\facade\Log;
use emailMessage;

Class EmailManage
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
   * 登陆发送qq邮箱
   * @Author laravelchen
   * @DateTime 2018-11-22
   * @param string $email 接收邮件者邮箱
   * @param string $name 接收邮件者名称
   * @param string $subject 邮件主题
   * @param string $body 邮件内容
   * @return   array();
   */
  public function sendEmailMsg($email,$name,$subject)
  {
    if(empty($email))
    {
       return return_format($this->str,20000,lang(20000));
    }
    $pattern = '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
    if(!preg_match($pattern,$email))
    {
      return return_format($this->str,20001,lang(20001));
    }
    //删除对应的手机号缓存
     Cache::rm('email'.$email);
    //随机验证码
    $body = rand(100000,999999);
    //调用短信接口，发送验证码
    $emailObj   = new emailMessage;
    $send_result = $emailObj->sendEmailMsg($email,$name,$subject,$body);
    if($send_result['result'] == 0)
    {
        return return_format('',0,lang('success'));
    }else{
        Log::write('发送邮件验证码错误消息:'.$send_result['result']);
    }

  }






}
