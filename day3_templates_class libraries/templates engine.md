# 什么是php模板引擎 #
PHP 模板引擎 广泛应用于分离模板和布局。

使用PHP模板引擎，可以让网站的维和更新容易，创造一个更加良好的开发环境，让开发和设计工作更容易结合在一起。
# 常见的模板引擎有哪些 #
##  Dwoo  ##
Dwoo是一个PHP5模板引擎。兼容Smarty模板，它在Smarty语法的基础上完全进行重写。支持通过插件扩展其功能。
##  Template Blocks ##
Template Blocks 是一个 可视化的模板引擎l, 这个模板引擎是轻量级、灵活和高度可扩展的。

你可以生成任何静态内容任何扩展且可以使用热门的扩展后缀，比如 .html, .htm 或 .php. 他们都将载入相同的内容。
## XTemplate ##
XTemplate是一个适用于PHP的模板引擎。它允许把HTML代码与PHP代码分开存储。XTemplate包含了许多有用的功能比如嵌套的程序块，各种类型的插值变量。其代码非常简洁并且是最优化的。
## FXL Template ##
FXL Template 是一个易于使用的模板引擎，包含一个引擎系统的所有功能。
# 什么是smarty模板引擎 #
smarty是一个基于PHP开发的PHP模板引擎。它提供了逻辑与外在内容的分离，简单的讲，目的就是要使PHP程序员同美工分离,使程序员改变程序的逻辑内容不会影响到美工的页面设计，美工重新修改页面不会影响到程序的逻辑，这在多人合作的项目非常实用。
# smarty模板引擎优点 #

	 1、速度快：smarty的编译性 使smarty调用编译后的文件而不每次都调用前台模板文件  (cache)并且smarty相对于其他的PHP模版，运行速度是最快的
     2、插件：smarty可以自己定义丰富的插件   可以自定义模版标签
     3、在smarty中有自己的丰富的 *模版* 控制的结构;   
     4、smarty经过编译，缓存后平均运行速度要快

# smarty模板引擎缺点 #

	1、中小型的项目不适合
	2、实时更新数据的网站中不适用
	3、第一次运行的时候 编译需要时间	

smarty模板配置

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
