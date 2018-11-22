<?php
use think\facade\Cache;
use think\facade\Config;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * phpmail邮件发送
 */

class emailMessage
{
  /**
   * 系统邮件发送函数
   * @param string $email 接收邮件者邮箱
   * @param string $name 接收邮件者名称
   * @param string $subject 邮件主题
   * @param string $body 邮件内容
   * @param string $attachment 附件列表
   * @return boolean
   * @author static7 <static7@qq.com>
   */
      public function sendEmailMsg($email,$name,$subject='',$body='',$attachment=null)
    {
          $username = Config::get('app.smtp163username');
          $password = Config::get('app.smtp163password');
          $setfromname=Config::get('app.smtp163fromname');

          $mail = new PHPMailer();           //实例化PHPMailer对象
          $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
          $mail->IsSMTP();                    // 设定使用SMTP服务
          $mail->SMTPDebug = 1;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
          $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
          $mail->SMTPSecure = 'ssl';          // 使用安全协议
          $mail->Host = "smtp.163.com";       // SMTP 服务器
          $mail->Port = 994;                  // SMTP服务器的端口号
          $mail->Username = $username;// SMTP服务器用户名
          $mail->Password = $password;// SMTP服务器密码,使用生成的授权码
          $mail->SetFrom($username, $setfromname);// 设置发件人邮箱地址 同登录账号
          $mail->isHTML(true);                // 邮件正文是否为html编码 注意此处是一个方法
          $mail->Subject = $subject;          // 添加该邮件的主题
          $mail->Body   = $body;
          $mail->AddAddress($email, $setfromname);   // 设置收件人邮箱地址
          $mail->addReplyTo($username, $password);
          if (is_array($attachment)) { // 添加附件
              foreach ($attachment as $file) {
                  is_file($file) && $mail->AddAttachment($file);
              }
          }
          if($mail->Send())
          {
              return $result['result']  = 0;
          }else{
              return $result['result']  = $mail->ErrorInfo;
          }
    }
}
