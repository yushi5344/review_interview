# get提交 #

get方式请求数据：

	get请求的数据会附在URL之后，以 ? 分割URL和传输数据，参数之间以 & 相连。

get方式提交的特点：

	（1）从指定资源获取数据
	（2）服务器端使用$_GET获取数据
	（3）get请求可被缓存、可被保留在浏览器历史记录中、可被收藏为书签
	（4） get 请求有长度限制（浏览器对URL长度的限定，不同的浏览器对URL长度的限定是不一样的。）
	
	（5） get 请求不应在处理敏感数据时使用（如果表单中有用户名和密码之类的信息，所谓的不安全）
	
	（6）传输的数据类型只能是ASCII字符。
	
	（7）在做数据查询时，建议用Get方式；

# post提交 #


post方式提交数据： 

	post 请求的 HTTP 消息主体中发送的


post方式提交的特点：

	（1）向指定资源提交数据
	（2）服务器段使用$_POST获取post方式提交的数据
	（3） post 请求不会被缓存、不会被保留在浏览器历史记录中、不会被收藏为书签
	（4） post 请求对数据长度无限制
	
	（5）处理一些敏感数据时使用post方式提交
	
	（6）传输的数据类型没有限制，可以是2进制。
	
	（7）做数据添加、修改或删除时，建议用Post方式

