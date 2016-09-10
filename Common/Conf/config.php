<?php
return array(
    //'配置项'=>'配置值'
    //显示底部跟踪信息
    'SHOW_PAGE_TRACE'     =>  FALSE,
    //默认分组设置
    'DEFAULT_MODULE'      =>  'Home',  // 默认模块
    //定义可以访问的模块
   'ALLOW_MODULE_LIST'   =>   array('Home','Manage'),
    //Smarty模板引擎切换
//    'TMPL_ENGINE_TYPE'    =>   'Smarty',    // 默认模板引擎 以下设置仅对使用Think模板引擎有效
    //为Smarty模板做配置
    'TMPL_TEMPLATE_SUFFIX'  =>  '.html',     // 默认模板文件后缀
     'URL_MODEL' => 1,

//    'URL_PATHINFO_DEPR'     =>  '&',	// PATHINFO模式下，各参数之间的分割符号
    //配置数据库
     //URL忽略大小写
    'URL_CASE_INSENSITIVE' => true,
    //REWRITE模式
    'URL_MODEL' => 2,
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'xs520',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'aa112200',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'xs_',    // 数据库表前缀

    //使用memcached缓存
    'SESSION_TYPE' => 'Memcache',
    'MEMCACHE_HOST' => '127.0.0.1',
    'MEMCACHE_PORT' => '11211',
    'SESSION_OPTIONS' => array(
        'name' => 'luohong',
        'expire' => 180000
    ),
    'SESSION_PREFIX' => 'luohong',

    'DATA_CACHE_TYPE' => 'Memcache',
    'DATA_CACHE_PREFIX' => 'luohong',

);
