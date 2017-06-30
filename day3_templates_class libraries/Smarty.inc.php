<?php
//设置时区
date_default_timezone_set("prc");
//定义绝对路径
define('ROOT_PATH',dirname(__FILE__));
//引入smarty
include ROOT_PATH.'/Smarty/Smarty.class.php';
$smarty=new Smarty();
//模板目录
$smarty->template_dir=ROOT_PATH.'/templates/';
//编译目录
$smarty->compile_dir=ROOT_PATH.'/templates_c/';
//缓存目录
$smarty->cache_dir=ROOT_PATH.'/cache/';
//配置目录
$smarty->config_dir=ROOT_PATH.'/config/';
//设置是否开启缓存
$smarty->caching=false;
//缓存生命周期
$smarty->cache_lifetime=10;
?>