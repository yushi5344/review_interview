# Ajax #
asynchronous JavaScript and xml.
## 基本原理 ##
在web浏览器使用JavaScript程序和服务器端脚本进行通信，并传递数据。
## 描述 ##
ajax相对用户来说是用来完成数据的验证、响应用户请求并与服务器异步传输数据。JavaScript使用XMLHttpRequest与服务器通信，改组件实现与服务器端数据交互，数据结构通常是用xml语言表述。
## 优缺点 ##
优点：  
ajax只需要更新想改变的内容，其他的数据并不参与服务器与客户端的信息传输，减轻了服务器负担，提高了网站的运行效率。(局部刷新)
ajax可以先将数据保存在本地，等待满足一定条件后再向服务器发送或者丢弃，可以先给用户一个快速的反应。
ajax是异步的，在ajax引擎更新数据的同时，页面还可以响应用户的其他操作。   
缺点：
ajax提交的数据不能过大
## 核心技术 ##
用JavaScript操作XMLHttpRequest从服务器中获取数据
ajax中POST和get传值的区别
get方法发送数据量较小，处理效率高，安全性低，会被缓存，而POST反之。 
ajax中防止传值缓存的方法
1.在服务器端加

	header("Cache-Control:no-cache,must-revalidate");

2.在ajax的url参数后随机加上一个参数或者时间戳为值的参数。

3.在ajax发送请求前加上：

	anyAjaxObj.setRequestHeader('If-Modified-Since','0');

4.在ajax发送请求前加上：	

	anyAjaxObj.setRequestHeader('Cache-Control','no-cache');

5.用post代替get

跨域请求的方法
ajax:通过jsonp创建动态script标签来突破浏览器同源限制。
proxy:首先将请求发送给后台服务器，通过服务器来发送请求，然后将讲求结果传递给前端。
cors:这是现代浏览器支持跨域请求资源的一种方式。
xdr:这是ie8和ie9提供的一种跨域请求解决方案。功能较弱，只支持get和post请求。

ajax源代码分析：  

ajax同步：

	addEvent(document, 'click', function () {
		var xhr = new XMLHttpRequest();						//创建XHR对象
		xhr.open('get', 'demo.php?rand=' + Math.random(), false);	//准备发送请求，以get方式请求，url是demo.php，同步
		xhr.send(null);									//发送请求，get不需要数据提交，则填写为null;
		if (xhr.status == 200) {
			alert(xhr.responseText);					//打印服务器端返回回来的数据
		} else {
			alert('获取数据错误！错误代号：' + xhr.status + '，错误信息：' + xhr.statusText);
		}
	});

使用XHR对象时，必须调用open方法，他接受三个参数，发送的请求类型(post,get)等，请求的url和是否异步
open方法并不会发送真正的请求，而是启动一个请求已备发送。通过send发送。

当发送到服务器端，收到响应后，响应的数据会自动填充xhr对象的属性，一共有4个属性

    responseText 响应的文本
    responseXML   如果响应的文本内容类型为“text/xml”则返回包含响应数据的xmldom文档
    status 响应的状态码
    statusText http状态码说明

http状态码

    200   OK   				  		成功返回
    400	  Bad request        		语法错误，服务器不识别
    401   Unauthorized   	 		请求需要用户认证
    404   Not Found 	 	 		url在服务器上找不到
    500   Internal Server Error  	服务器错误
    503   Service Unavailable		服务器过载或者无法完成请求

异步调用时，需要触发readystatechange事件，然后检测readystate属性即可。这个属性的五个值：

	0    未初始化    尚未调用open方法
	1    启动		已经调用了open方法，但尚未调用send()方法
	2	 发送		已经调用send方法，但尚未接受响应
	3    接受		已经接受到部分响应数据
	4	 完成		已经接受到全部数据

使用post提交，ajax异步部分代码

	//POST请求
	addEvent(document, 'click', function () {
		var xhr = new XMLHttpRequest;		
		var url = 'demo.php?rand=' + Math.random();
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					alert(xhr.responseText);
				} else {
					alert('获取数据错误！错误代号：' + xhr.status + '，错误信息：' + xhr.statusText);
				}	
			}
		};
		xhr.open('post', url, true);							//第一步改为post
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');		//第三步，模拟表单提交
		xhr.send('name=Lee&age=100');			//第二步将名值对放入send方法里
	});

