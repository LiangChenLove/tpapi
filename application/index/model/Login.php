<?php
  namespace app\index\model;

  use think\Db;

  class Login
  {
      //分类添加验证规则
      public $rule = [
          'username' => 'require',
          'type'     => 'require',
          'source'   => 'require',
          'key'      => 'require',
      ];
      //自定义初始化
      public $message = [];
      //自定义初始化
      protected function _initialize()
      {
          $this->message = [
              'username.require' => lang('10003'),
              'type.require'     => lang('10004'),
              'source.require'   => lang('10005'),
              'key.require'      => lang('10006'),
          ];
      }
  }
