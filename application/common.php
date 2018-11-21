<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*
*   [return_format] 返回格式化数据
*   @Author laravelchen
*   @DateTime 2018-11-21
*   @param     $data  数据
*   @param     $code  错误码
*   @param     $info  返回错误描述
*/

  function return_format($data,$code=0,$info='')
  {
      if($info === '')
      {
          $info = $code == 0 ? lang('success'):lang(strval($code));
      }
      return ['code'=>$code,'data'=>$data,'info'=>$info];
  }
  /*
  *   [object_to_array] 对象转数组
  *   @Author laravelchen
  *   @DateTime 2018-11-21
  *   @param     $obj  对象
  */
  function object_to_array($obj)
  {
      $obj = (array)$obj;
      foreach ($obj as $key => $value)
      {
          if(gettype($value) == 'resource')
          {
              return ;
          }
          if(gettype($value) == 'object' || gettype($value) == 'array')
          {
            $obj[$k] = (array)object_to_array($v);
          }
      }
      return $obj;
  }
