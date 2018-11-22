<?php
use tencentSMS\SmsSingleSender;
use think\facade\Cache;
use think\facade\Config;

require_once "tencentSMS/SmsSingleSender.php";

/**
 * 腾讯云SMS短信发送
 */

class tencentMessage
{
	// 短信应用SDK AppID
	protected $appid;
	// 短信应用SDK AppKey
	protected $appkey;
	protected $smsSign;

	public function __construct()
	{
			$this->appid  = Config::get('app.tencentSmsAppid');
			$this->appkey = Config::get('app.tencentSmsAppkey');
			$this->smsSign= Config::get('app.tencentSmsSign');
	}

	// dump($this->$appid);die;
	/**
	 * 短信发送接口 指定模版
	 * @Author laravelchen
   * @DateTime 2018-11-21
	 * @param $[mobile]  [手机号]
	 * @param $[type]    [模板  4 短信验证码 ]
	 * @param $[params]  [传数组 对应短信模板值 模板所需参数几个就传几个 顺序和模板顺序一样 键从0开始]
	 * @param $[$prophone] [手机号前缀]
	 * @param $[identifytype] [标识类型 根据业务传输字符串 限制验证码使用区间,用来判断短信使用场景]
	 * @return array()
	 */
	public function sendMobileMsg($mobile,$type=4,$params = [],$prophone = '86',$identifytype=''){
			if(Cache::get('mobile'.$mobile.$identifytype)){
        //判断是否在10分钟内
				$params[0] = Cache::get('mobile'.$mobile.$identifytype);
			}else{
        // 短信模板时 缓存对应的验证码10分钟
				Cache::set('mobile'.$mobile.$identifytype,$params[0],600);
			}
		$sign = "";

		// 对应中文模版ID，多个模板可以进行对应匹配
		$typearr = ['4'=>'183495'];

		try {
			$ssender = new SmsSingleSender($this->appid, $this->appkey);
			$result = $ssender->sendWithParam($prophone, $mobile, $typearr[$type],$params, $sign, "", "");
			// 签名参数未提供或者为空时，会使用默认签名发送短信
			$rsp = object_to_array(json_decode($result));
			return $rsp;
		} catch(\Exception $e) {
			return ['result'=>100,'info'=>'短信发送失败'];
		}
	}
}
