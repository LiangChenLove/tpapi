<?php
namespace login;
/*
* 本地使用 私钥 解密
* 用户使用 公钥 加密
*/
class Rsa
{
    private $private_key_path;
    private $public_key_path = './key/public.pem';
    //初始化
    public function __construct($public='')
    {
        //公钥和私钥在本地的存储位置
        $this->private_key_path = dirname(__FILE__).'/key/private.pem';
        $this->public_key_path  = dirname(__FILE__).'/key/public.pem';
    }
    /*
    * RSA解密
    * @param $data 需要解密的内容，密文
    * @param $private_key_path 商户私钥文件路径
    * return 解密后的内容，明文
    */
    function rsaDecryptorign($data)
    {
        //打开私钥文件
        $private_key = file_get_contents($this->private_key_path);
        //解析私钥供其他函数使用
        $rsa         = openssl_get_privatekey($private_key);
        $crypto      = '';
        //截取内容中的字符
        $arrkey      = str_split($data,344);
        foreach ($arrkey as $chunk)
        {
            //对使用 MIME base64 编码的数据进行解码
            $chunk   = base64_decode($chunk);
            //使用私钥$rsa解密数据,传入数据+解密之后明文数据+私钥
            $bool    = openssl_private_decrypt($chunk,$decryptData,$rsa);
            //明文片段拼接
            $crypto .= $decryptData;
            $decryptData = '';
        }
        //释放密钥资源
        openssl_free_key($rsa);
        return $crypto;
    }

}
