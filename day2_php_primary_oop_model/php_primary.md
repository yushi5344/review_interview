# php初级 #
## 1.基本语法 ##

    gettype和settype()
    intval(),floatval(),strval().

## 2.操作符和控制结构 ##

    if条件判断语句
    switch语句
    while循环
    for循环
    do while 循环

## 3.数学运算 ##
### rand()和mt_rand() ###
rand()是libc中定义的随机函数的一个简单包装器。mt_rand()是一个很好的替代
### 格式化数据 ###
number_format()接受1,2,4个参数
### 其他数学函数 ###

    abs()绝对值
    floor()舍去法取整
    ceil()进一法取整
    round()四舍五入
    min()最小值
    max()最大值

## 4.数组 ##
### 数组排序 ###

    正向排序：sort(),asort(),ksort()
    反向排序: rsort(),arsort(),krsort().
    array_reverse()将原来数组反向排序
    array_unshift()将新元素添加到数组头部,array_push()将新元素添加到数组尾部
    array_shift()删除数组头部第一个元素，array_pop()删除数组末尾的一个元素
    array_rand()返回数组中一个或多个键。

### 数组指针操作 ###

	each(),current(),reset(),end(),next(),pos(),prev();

### 数组个数统计 ###

    count()和sizeof()统计数组下标的个数
    array_count_values()统计数组内下标值的个数

### 映射 ###

	extract();

## 5.目录和文件 ##
### 目录操作 ###

    解析目录路径：basename()文件名
    获取路径的目录dirname()文件路径目录
    路径信息：pathinfo();
    绝对路径：realpath();

### 磁盘、目录和文件计算 ###
    
    文件大小：filesize();
    磁盘可用空间：disk_free_space();
    磁盘总容量：disk_total_space();
    文件最后访问时间：fileatime();
    文件最后修改时间：filemtime();
### 文件处理 ###

	fopen('file.txt','w+');

fopen()函数第二个参数为文件模式

    r   只读  指针在文件开头
    r+  读写  开头
    w   只写  写入前删除文件内容，指针返回头部，文件不存在则尝试创建
    w+  读写  在读取或写入前，删除文件内容，指针返回头部，文件不存在尝试创建
    a   只写  指针在文件末尾（append）
    a+  读写	  指针在文件末尾 追加文件

写文件
 
	fwrite($fp,'addd');

fwrite()的替换函数

	file_put_contents();

关闭文件

	fclose();

读出文件

	$fp=fopen('a.php','r');

常用函数

    fgetc()读取一个字符，并将指针移到下一个字符
    fgets()读取一行字符，可以指定一行显示的长度
    fgetss()从文件指针中读取一行并过滤掉HTML标记
    fread()读取定量的字符
    file()将整个文件读取到数组中，以行分组
    readfile()读入一个文件并写入到输出缓冲
    file_get_contents() 将整个文件读入一个字符串
    feof() 判断文件是否读完 读完返回true
    file_exists()查看文件是否存在
    unlink() 删除一个文件
    rewind()可以将文件指针复位到文件开始

目录句柄操作

    opendir():  打开路径指定的目录流
    closedir(): 关闭目录流
    readdir():  返回目录中各个元素

将目录写入数组

	scandir();

删除指定的目录

	rmdir();

重命名文件

	rename();

include和require的区别

	include是包含，如果没有文件则报一个警告，而require是需要，如果不存在要引入的文件，则报一个致命错误。

php魔法常量

    __FILE__   当前文件名
    __LINE__   当前行号
    __FUNCTION__   当前函数名
    __CLASS__  当前类名
    __METHOD__ 当前方法名

## 字符串处理 ##
### 字符串格式化 ###
清理字符串的空格

    chop()移除字符串后面多余的空白，包括新行
    ltrim() 删除左边空白
    rtrim()删除右边空白
    trim()删除两边空白
	explode()将字符串炸成数组

使用strtok函数

	strtok()函数一次只从字符串取出一些片段。

str_split()返回一个数组，各数组元素分别是字符串参数中的一个字符串

	print_r(str_split('this is  a teacher'));

输出值为

	Array ( [0] => T [1] => h [2] => i [3] => s [4] => [5] => i [6] => s [7] => [8] => a [9] => [10] => T [11] => e [12] => a [13] => c [14] => h [15] => e [16] => r [17] => ! )

strrev()可以将一个字符串翻转过来。

### 字符串比较函数 ###

	strcmp()如果两个字符串相等，返回0，如果按字典排序，str1>str2,则返回一个正数。
	strspn()获取两个字符串之间的相同部分。
	strlen()获取字符串长度
	substr_count()返回一个字符串在另一个字符串中出现的次数。

### 查找替换字符串 ###

	strstr()在字符串中查找字符串  同strchr()
	str_replace(),str_ireplace()和substr_replace()

## 正则表达式 ##
### 量词 ###

    \+     任何至少一个前导字符串
    \*     任何零个或多个前导字符串
    ?     任何零个或一个前导字符串
    .     任意字符串
    {x}   任何包含x个前导字符串
    {x,y} 任何包含x到y个前导字符串
    {x,}  至少包含x个前导字符串
    $     行尾
    ^     行首
    |     左边或者右边

### 元字符 ###

	[a-z]
	[A-Z]
	[0-9]同\d
	[abc]
	[^abc]  匹配不包含abc的字符串
	[a-zA-Z0-9_]同  \w
	[^a-zA-Z0-9_]同 \W	
	\D 同[^0-9]

### 修饰符 ###

	i   完成不区分大小写的搜索
	m   在匹配首内容或者尾内容的时候采用多行识别匹配
	x   忽视正则中的空白
	A   强制从头开始匹配
	U   禁止贪婪

### Perl风格函数 ###

	preg_grep()
	搜索数组中的所有元素，返回由某个模式匹配的所有元素的数组

	preg_match()
	在在字符串中搜索模式，存在返回TRUE，否则FALSE。

	preg_match_all()
	匹配模式的所有出现，然后将匹配到的全部放入数组

	preg_replace()
	替换模式的所有出现

## 日期和时间 ##
将时间戳转换成友好的值
	
	print_r(getdate());

返回值为

	Array ( 
		[seconds] => 44
		[minutes] => 19
		[hours] => 13 
		[mday] => 29 
		[wday] => 4 
		[mon] => 6 
		[year] => 2017
		[yday] => 179 
		[weekday] => Thursday
		[month] => June 
		[0] => 1498713584
	 	) 

获取指定的时间戳

	echo mktime(12,12,12,12,12,2017);

将日期转换成时间戳

	echo strtotime('2017-12-12 12:12:12');

获取当前文件最后修改时间

	echo date('Y-m-d H:i:s',getlastmod());

计算页面脚本运行时间可能用到的函数

	microtime();   返回msec字符串，sec为当前Unix时间戳

Header函数

	header('Location:http://www.baidu.com');