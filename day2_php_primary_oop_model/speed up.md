# PHP开启opcache方法 #

**注意：**
大家知道目前PHP的缓存插件一般有三个：APC、eAccelerator、XCache，但未来它们可能都会消失，因为PHP 5.5已经集成ZendOpcache，功能和前三者相似但又有少许不同，缓存速度据说比它们更快（注意：只是据说，我没测试过）。

这几个PHP加速插件的主要原理都相同，就是把PHP执行后的数据缓冲到内存中从而避免重复的编译过程，能够直接使用缓冲区已编译的代码从而提高速度，降低服务器负载，它们的效率是显而易见的，像drupal这种庞大的CMS，每次打开一个页面要调用数十个PHP文件，执行数万行代码，效率可想而知，在安
装APC等加速器后打开页面的速度明显加快。

Zend Opcache 已经集成在了PHP 5.5里面，编译安装PHP5.5的时候加上--enable-opcache就行了。但也支持低版本的。

## 1、打开php.ini文件 ##

## 2、找到：[opcache]，设置为： ##

	[opcache]
	; dll地址
	zend_extension=php_opcache.dll
	; 开关打开
	opcache.enable=1
	; 开启CLI
	opcache.enable_cli=1
	; 可用内存, 酌情而定, 单位为：Mb
	opcache.memory_consumption=528
	; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
	opcache.interned_strings_buffer=8
	; 对多缓存文件限制, 命中率不到 100% 的话, 可以试着提高这个值
	opcache.max_accelerated_files=10000
	; Opcache 会在一定时间内去检查文件的修改时间, 这里设置检查的时间周期, 默认为 2, 定位为秒
	opcache.revalidate_freq=1
	; 打开快速关闭, 打开这个在PHP Request Shutdown的时候回收内存的速度会提高
	opcache.fast_shutdown=1

## 3、重启apache即可。 ##

	[opcache]
	zend_extension = "G:/PHP/php-5.5.6-Win32-VC11-x64/ext/php_opcache.dll"
	 
	; Zend Optimizer + 的开关, 关闭时代码不再优化.
	opcache.enable=1
	 
	; Determines if Zend OPCache is enabled for the CLI version of PHP
	opcache.enable_cli=1
	 
	 
	; Zend Optimizer + 共享内存的大小, 总共能够存储多少预编译的 PHP 代码(单位:MB)
	; 推荐 128
	opcache.memory_consumption=64
	 
	; Zend Optimizer + 暂存池中字符串的占内存总量.(单位:MB)
	; 推荐 8
	opcache.interned_strings_buffer=4
	 
	 
	; 最大缓存的文件数目 200  到 100000 之间
	; 推荐 4000
	opcache.max_accelerated_files=2000
	 
	; 内存“浪费”达到此值对应的百分比,就会发起一个重启调度.
	opcache.max_wasted_percentage=5
	 
	; 开启这条指令, Zend Optimizer + 会自动将当前工作目录的名字追加到脚本键上,
	; 以此消除同名文件间的键值命名冲突.关闭这条指令会提升性能,
	; 但是会对已存在的应用造成破坏.
	opcache.use_cwd=0
	 
	 
	; 开启文件时间戳验证 
	opcache.validate_timestamps=1
	 
	 
	; 2s检查一次文件更新 注意:0是一直检查不是关闭
	; 推荐 60
	opcache.revalidate_freq=2
	 
	; 允许或禁止在 include_path 中进行文件搜索的优化
	;opcache.revalidate_path=0
	 
	 
	; 是否保存文件/函数的注释   如果apigen、Doctrine、 ZF2、 PHPUnit需要文件注释
	; 推荐 0
	opcache.save_comments=1
	 
	; 是否加载文件/函数的注释
	;opcache.load_comments=1
	 
	 
	; 打开快速关闭, 打开这个在PHP Request Shutdown的时候会收内存的速度会提高
	; 推荐 1
	opcache.fast_shutdown=1
	 
	;允许覆盖文件存在（file_exists等）的优化特性。
	;opcache.enable_file_override=0
	 
	 
	; 定义启动多少个优化过程
	;opcache.optimization_level=0xffffffff
	 
	 
	; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
	;opcache.inherited_hack=1
	 
	; 启用此Hack可以暂时性的解决”can’t redeclare class”错误.
	;opcache.dups_fix=0
	 
	; 设置不缓存的黑名单
	; 不缓存指定目录下cache_开头的PHP文件. /png/www/example.com/public_html/cache/cache_ 
	;opcache.blacklist_filename=
	 
	 
	; 通过文件大小屏除大文件的缓存.默认情况下所有的文件都会被缓存.
	;opcache.max_file_size=0
	 
	; 每 N 次请求检查一次缓存校验.默认值0表示检查被禁用了.
	; 由于计算校验值有损性能,这个指令应当紧紧在开发调试的时候开启.
	;opcache.consistency_checks=0
	 
	; 从缓存不被访问后,等待多久后(单位为秒)调度重启
	;opcache.force_restart_timeout=180
	 
	; 错误日志文件名.留空表示使用标准错误输出(stderr).
	;opcache.error_log=
	 
	 
	; 将错误信息写入到服务器(Apache等)日志
	;opcache.log_verbosity_level=1
	 
	; 内存共享的首选后台.留空则是让系统选择.
	;opcache.preferred_memory_model=
	 
	; 防止共享内存在脚本执行期间被意外写入, 仅用于内部调试.
	;opcache.protect_memory=0