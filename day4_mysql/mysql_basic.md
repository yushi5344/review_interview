# web数据库概述 #
数据库结构分为：

- 网状数据库
- 分布式数据库
- 关系型数据库

关系型数据库优点：

1. 比普通文件的书库访问更快
2. 具有专门的内置机制处理并发访问
3. 可以提供对数据的随即访问
4. 具有内置的权限系统

如何设计web数据库

1. 考虑要建模的实际对象
2. 避免保存冗余数据
3. 使用原子列值
4. 选择有意义的键
5. 考虑需要查询数据库的问题
6. 避免多个空属性的设计

# mysql操作 #
显示当前存在的数据库

	show databases();

选择需要的数据库

	use wepiao;

查看当前选择的数据库

	select database();

查看这个库有多少张表

	show tables;

查看一张表的所有内容

	select * from wp_link;

创建一个数据库

	create database book;

在数据库里创建一张表

	create table book(
		user varchar(20),
		sex char(1),
		birth datetime);

显示表的结构

	describe wp_link;

修改数据表名称

	rename table wp_link to wp_links;	

增加表字段

	alter table wp_link add state char(1) default 0;

删除字段

	alter table wp_link drop state;

修改字段属性

	alter table wp_link modify type char(1) default 1;
	
修改字段名称

	alter table wp_link  change type state cahr(1) not null;

给表插入一条数据

	INSERT INTO user (username,sex,birth)values('lee','x','now()');

筛选指定的数据

	select * from user where id =1;

修改指定的数据

	update user set username='wang' where id =1;

删除指定的数据

	delete from user where id=1;

删除指定的表

	drop table user;

删除指定的数据库

	drop database book;

检查这个表的信息

	show table status;

优化一张表

	optimize table grade;

# PHP操作MySQL #
php连接mysql

	$conn=mysql_connect(host,user,password) or die('数据库连接错误'.mysql_error());

选择数据库

	mysql_select _db('wepiao');

设置字符集

	mysql_query('SET NAMES UTF8');

获取记录集

	$query="select * from grade";
	$result=mysql_query($query);

释放结果集资源

	mysql_free_result($result);

关闭数据库

	mysql_clone($_conn);

# php中常用的操作mysql的函数 #

	mysql_fetch_row() 从结果集中取得一行作为枚举数组
	mysql_fetch_assoc()从结果集中取得一行作为关联数组
	mysql_fetch_array()关联或者枚举二者皆有
	
	mysql_fetch_lengths()取得结果集中每个输出的长度
	mysql_field_name()取得结果集中指定字段的字段名
	
	mysql_num_rows() 取得结果集中行的数目
	mysql_num_fields()取得结果集中字段的数目


