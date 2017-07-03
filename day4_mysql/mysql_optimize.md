## MySQL引擎 ##

a.Innodb引擎   

Innodb引擎提供了对数据库ACID事务的支持。并且还提供了行级锁和外键的约束。它的设计的目标就是处理大数据容量的数据库系统。它本身实际上是基于Mysql后台的完整的系统。Mysql运行的时候，Innodb会在内存中建立缓冲池，用于缓冲数据和索引。5.6后支持全文索引，启动比较的慢，它是不会保存表的行数的。当进行Select count(*) from table指令的时候，需要进行扫描全表。所以当需要使用数据库的事务时，该引擎就是首选。由于锁的粒度小，写操作是不会锁定全表的。所以在并发度较高的场景下使用会提升效率的。

b.MyIASM引擎   

它是MySql的默认引擎，但不提供事务的支持，也不支持行级锁和外键。因此当执行Insert插入和Update更新语句时，即执行写操作的时候需要锁定这个表。所以会导致效率会降低。不过和Innodb不同的是，MyIASM引擎是保存了表的行数，于是当进行Select count(*) from table语句时，可以直接的读取已经保存的值而不需要进行扫描全表。所以，如果表的读操作远远多于写操作时，并且不需要事务的支持的。可以将MyIASM作为数据库引擎的首先。   

补充2点：

c.大容量的数据集时趋向于选择Innodb。因为它支持事务处理和故障的恢复。Innodb可以利用数据日志来进行数据的恢复。主键的查询在Innodb也是比较快的。     
d.大批量的插入语句时（这里是INSERT语句）在MyIASM引擎中执行的比较的快，但是UPDATE语句在Innodb下执行的会比较的快，尤其是在并发量大的时候。

Mysql innodb支持的外键： MYSQL数据表建立外键

MySQL创建关联表可以理解为是两个表之间有个外键关系，但这两个表必须满足三个条件  

1. 两个表必须是InnoDB数据引擎
2. 使用在外键关系的域必须为索引型(Index)
3. 使用在外键关系的域必须与数据类型相似


例如：
1、建立s_user表

	create table s_user(
       u_id int auto_increment primary key,
       u_name varchar(15),
       u_pwd varchar(15),
       u_truename varchar(20),
       u_role varchar(6),
       u_email varchar(30)
	)

2、插入几条数据

	insert into s_user values
              (1,"wangc","aaaaaa","wangchao","buyer","wang@163.com"),
              (2,"huangfp","bbbbbb","huangfp","seller","huang@126.com"),
              (3,"zhang3","cccccc","zhangsan","buyer","zhang@163.com"),
              (4,"li4","dddddd","lisi","seller","li@1256.com")

3、建立s_orderform表
		
	create table s_orderform(
	    o_id int auto_increment primary key,
	    o_buyer_id int,
	    o_seller_id int,
	    o_totalprices double,
	    o_state varchar(50),
	    o_information varchar(200),
		foreign key(o_buyer_id) references s_user(u_id),      #外链到s_user表的u_id字段
		foreign key(o_seller_id) references s_user(u_id)      #外链到s_user表的u_id字段
	)

## Mysql索引 ##

[参考文章](http://blog.csdn.net/xluren/article/details/32746183)

索引分为聚簇索引和非聚簇索引两种，聚簇索引是按照数据存放的物理位置为顺序的，而非聚簇索引就不一样了；聚簇索引能提高多行检索的速度，而非聚簇索引对于单行的检索很快。 

### 普通索引 ###

这是最基本的索引，它没有任何限制，比如上文中为title字段创建的索引就是一个普通索引，MyIASM中默认的BTREE类型的索引，也是我们大多数情况下用到的索引。

直接创建索引

	CREATE INDEX index_name ON table(column(length))

修改表结构的方式添加索引

	ALTER TABLE table_name ADD INDEX index_name ON (column(length))

创建表的时候同时创建索引

	CREATE TABLE `table` (
	`id` int(11) NOT NULL AUTO_INCREMENT ,
	`title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`time` int(10) NULL DEFAULT NULL ,
	PRIMARY KEY (`id`),
	INDEX index_name (title(length))

删除索引

	DROP INDEX index_name ON table

### 唯一索引 ###

与普通索引类似，不同的就是：索引列的值必须唯一，但允许有空值（注意和主键不同）。如果是组合索引，则列值的组合必须唯一，创建方法和普通索引类似。

创建唯一索引

	CREATE UNIQUE INDEX indexName ON table(column(length))

修改表结构

	ALTER TABLE table_name ADD UNIQUE indexName ON (column(length))

创建表的时候直接指定

	`id` int(11) NOT NULL AUTO_INCREMENT ,
	`title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`time` int(10) NULL DEFAULT NULL ,
	PRIMARY KEY (`id`),
	UNIQUE indexName (title(length)));

### 全文索引（FULLTEXT） ###

MySQL从3.23.23版开始支持全文索引和全文检索，FULLTEXT索引仅可用于 MyISAM 表（5.6以后innodb也支持fulltext）；他们可以从CHAR、VARCHAR或TEXT列中作为CREATE TABLE语句的一部分被创建，或是随后使用ALTER TABLE 或CREATE INDEX被添加。////对于较大的数据集，将你的资料输入一个没有FULLTEXT索引的表中，然后创建索引，其速度比把资料输入现有FULLTEXT索引的速度更为快。不过切记对于大容量的数据表，生成全文索引是一个非常消耗时间非常消耗硬盘空间的做法。

创建表的适合添加全文索引

	CREATE TABLE `table` (
	`id` int(11) NOT NULL AUTO_INCREMENT ,
	`title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
	`content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
	`time` int(10) NULL DEFAULT NULL ,
	PRIMARY KEY (`id`),
	FULLTEXT (content)	);

修改表结构添加全文索引

	ALTER TABLE article ADD FULLTEXT index_content(content)

直接创建索引

	CREATE FULLTEXT INDEX index_content ON article(content)


## Mysql sql语句优化： ##

- 1.将经常要用到的字段（比如经常要用这些字段来排序，或者用来做搜索），则最好将这些字段设为索引。
- 2.字段的种类尽可能用int 或者tinyint类型。另外字段尽可能用NOT NULL。
- 3.当然无可避免某些字段会用到text ,varchar等字符类型，最好将text字段的单独出另外一个表出来（用主键关联好）
- 4.字段的类型，以及长度，是一个很考究开发者优化功力的一个方面。如果表数据有一定的量了，不妨用PROCEDURE ANALYSE()命令来取得字段的优化建议！（在phpmyadmin里可以在查看表时，点击 “Propose table structure”      来查看这些 建议） 如此可以让你的表字段结构 趋向完善。
- 5.select * 尽量少用，你想要什么字段 就select 什么字段出来 不要老是用* 号！同理，只要一行数据时尽量使用 LIMIT 1
- 6.绝对不要轻易用order by rand() ，很可能会导致mysql的灾难！！
- 7.每个表都应该设置一个ID主键，最好的是一个INT型，并且设置上自动增加的AUTO_INCREMENT标志，这点其实应该作为设计表结构的第一件必然要做的事！！
- 8.拆分大的 DELETE 或 INSERT 语句。因为这两个操作是会锁表的，表一锁住了，别的操作都进不来了，就我来说 有时候我宁愿用for循环来一个个执行这些操作。
- 9.不要用永久链接 mysql_pconnect()；除非你真的非常肯定你的程序不会发生意外，不然很可能也会导致你的mysql死掉。
- 10.永远别要用复杂的mysql语句来显示你的聪明。就我来说，看到一次关联了三，四个表的语句，只会让人觉得很不靠谱。 

## 数据库的事务： ##

[参考文章](http://www.cnblogs.com/gomysql/p/3632209.html)

事务是数据库的一句或一系列的操作，事务可以保证能够在数据库中作为一个整体全部执行 或者 全部不执行  

事务有以下四个标准属性的缩写ACID，通常被称为：

- 原子性:atomicity， 每个事务都是业务的最小单元，一个事务执行不影响其他事务
- 隔离性:consistency,一个事务在处理时，其他事务必须等待/一个的事务的处理不影响其他事务
- 一致性:isolation, 事务处理前和事务处理后，数据保持了总数的一致性
- 永久性: durability, 事务如果成功提交后，数据将对数据库做永久性的改变，无法还原

### 独占锁（Exclusive Lock) ###
独占锁锁定的资源只允许进行锁定操作的程序使用，其它任何对它的操作均不会被接受。执行数据更新命令，即INSERT、 UPDATE 或DELETE 命令时，SQL Server 会自动使用独占锁。但当对象上有其它锁存在时，无法对其加独占锁。独占锁一直到事务结束才能被释放。
### 共享锁（Shared Lock) ###
共享锁锁定的资源可以被其它用户读取，但其它用户不能修改它。在SELECT 命令执行时，SQL Server 通常会对对象进行共享锁锁定。通常加共享锁的数据页被读取完毕后，共享锁就会立即被释放。
### 更新锁（Update Lock) ###
更新锁是为了防止死锁而设立的。当SQL Server 准备更新数据时，它首先对数据对象作更新锁锁定，这样数据将不能被修改，但可以读取。等到SQL Server 确定要进行更新数据操作时，它会自动将更新锁换为独占锁。但当对象上有其它锁存在时，无法对其作更新锁锁定。 



## Mamcached-11211和redis-6479： ##

- 1、Redis和Memcache都是将数据存放在内存中，都是内存数据库。不过memcache还可用于缓存其他东西，例如图片、视频等等；
- 2、Redis不仅仅支持简单的k/v类型的数据，同时还提供list，set，hash等数据结构的存储；
- 3、虚拟内存--Redis当物理内存用完时，可以将一些很久没用到的value 交换到磁盘；
- 4、过期策略--memcache在set时就指定，例如set key1 0 0 8,即永不过期。Redis可以通过例如expire 设定，例如expire name 10；
- 5、分布式--设定memcache集群，利用magent做一主多从;redis可以做一主多从。都可以一主一从；
- 6、存储数据安全--memcache挂掉后，数据没了；redis可以定期保存到磁盘（持久化）；
- 7、灾难恢复--memcache挂掉后，数据不可恢复; redis数据丢失后可以通过aof恢复；
- 8、Redis支持数据的备份，即master-slave模式的数据备份；
- 9、应用场景不一样：Redis出来作为NoSQL数据库使用外，还能用做消息队列、数据堆栈和数据缓存等；Memcached适合于缓存SQL语句、数据集、用户临时性数据、延迟查询数据和session等
