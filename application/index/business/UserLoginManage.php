<?php
namespace app\index\business;

use think\Controller;
use login\Rsa;

class UserLoginManage extends Controller
{
    /*
    * 公钥解密
    *@param $data[key:前端加密的标识，前端生成后保存在后端]
    *@return array
    **/
    public function rsaDecode()
    {
        if(!empty($data))
        {
            $rsa = new Rsa;
            return json_decode($rsa->rsaDecryptorign($data),true);
        }else{
            return [];
        }
    }

    public function login($data)
    {
        //公钥密钥
        $data = $this->rsaDecode($data);
        $data = where_filter($data,['key','username','password','type','prophone','source','code']);

        $login= new Login;
        $validate = new Validate($login->rule,$login->message);
        if(!$validate->check($data))
        {
            return return_format('',10210,$validate->getError());
        }
    }


}
