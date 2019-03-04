<?php
/**
 * * ---------------------------------------------------------------------
 * 通用入口文件（开发环境）
 * @author yangjian102621@gmail.com
 * ---------------------------------------------------------------------
 * Copyright (c) 2013-now http://www.r9it.com All rights reserved.
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------------------------------------
 */
//设置页面编码
header("Content-Type:text/html; charset=utf-8");
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);
// 是否记录 sql 日志
define('SQL_LOG', true);
//定义时区
define('TIME_ZONE', 'PRC');
define('APP_NAME', 'app');
//设置错误等级
define('ERROR_LEVEL', E_ALL & ~E_NOTICE  & ~E_WARNING &~E_STRICT);
// 定义系统根目录
define('APP_ROOT', dirname(__DIR__) . '/');
define('SERVER_NODE', 0x01); //当前服务器节点，分布式部署时需要使用
define('APP_PATH', APP_ROOT.'app/'); //当前应用根目录
//定义环境参数配置文档目录
define('ENV_CFG', 'dev');
//初始化自动加载
require APP_ROOT . "vendor/autoload.php";
