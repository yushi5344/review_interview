# 正确理解cookie和session机制原理 #
php中cookie和session是我们常用的两个变量了，一个是用户客户端的，一个用在服务器的但他们的区别与工作原理怎么样，下面我们一起来看看cookie和session机制原理吧。   
 

## cookie和session机制之间的区别和联系 ##

具体来说cookie机制采用的是在客户端保持状态的方案。它是在用户端的会话状态的存贮机制，他需要用户打开客户端的cookie支持。cookie的作用就是为了解决HTTP协议无状态的缺陷所作的努力.

而session机制采用的是一种在客户端与服务器之间保持状态的解决方案。同时我们也看到，由于采用服务器端保持状态的方案在客户端也需要保存一个标识，所以session机制可能需要借助于cookie机制来达到保存标识的目的。而session提供了方便管理全局变量的方式

session是针对每一个用户的，变量的值保存在服务器上，用一个sessionID来区分是哪个用户session变量,这个值是通过用户的浏览器在访问的时候返回给服务器，当客户禁用cookie时，这个值也可能设置为由get来返回给服务器。

就安全性来说：当你访问一个使用session的站点，同时在自己机子上建立一个cookie，建议在服务器端的SESSION机制更安全些.因为它不会任意读取客户存储的信息。

正统的cookie分发是通过扩展HTTP协议来实现的，服务器通过在HTTP的响应头中加上一行特殊的指示以提示浏览器按照指示生成相应的cookie

从网络服务器观点看所有HTTP请求都独立于先前请求。就是说每一个HTTP响应完全依赖于相应请求中包含的信息

状态管理机制克服了HTTP的一些限制并允许网络客户端及服务器端维护请求间的关系。在这种关系维持的期间叫做会话(session)。

Cookies是服务器在本地机器上存储的小段文本并随每一个请求发送至同一个服务器。IETFRFC2965HTTPStateManagementMechanism是通用cookie规范。网络服务器用HTTP头向客户端发送cookies，在客户终端，浏览器解析这些cookies并将它们保存为一个本地文件，它会自动将同一服务器的任何请求缚上这些cookies

-------------------------------------------------------------------------------------------------------------------------------------------------------------------

## 理解session机制 ##

session机制是一种服务器端的机制，服务器使用一种类似于散列表的结构（也可能就是使用散列表）来保存信息。

当程序需要为某个客户端的请求创建一个session的时候，服务器首先检查这个客户端的请求里是否已包含了一个session标识-称为sessionid，如果已包含一个sessionid则说明以前已经为此客户端创建过session，服务器就按照sessionid把这个session检索出来使用（如果检索不到，可能会新建一个），如果客户端请求不包含sessionid，则为此客户端创建一个session并且生成一个与此session相关联的sessionid，sessionid的值应该是一个既不会重复，又不容易被找到规律以仿造的字符串，这个sessionid将被在本次响应中返回给客户端保存。

保存这个sessionid的方式可以采用cookie，这样在交互过程中浏览器可以自动的按照规则把这个标识发挥给服务器。一般这个cookie的名字都是类似于SEEESIONID，而。比如weblogic对于web应用程序生成的cookie，JSESSIONID=ByOK3vjFD75aPnrF7C2HmdnV6QZcEbzWoWiBYEnLerjQ99zWpBng!-145788764，它的名字就是JSESSIONID。

由于cookie可以被人为的禁止，必须有其他机制以便在cookie被禁止时仍然能够把sessionid传递回服务器。经常被使用的一种技术叫做URL重写，就是把sessionid直接附加在URL路径的后面，附加方式也有两种，一种是作为URL路径的附加信息，表现形式为

	http://...../xxx;jsessionid=ByOK3vjFD75aPnrF7C2HmdnV6QZcEbzWoWiBYEnLerjQ99zWpBng!-145788764


另一种是作为查询字符串附加在URL后面，表现形式为

	http://...../xxx?jsessionid=ByOK3vjFD75aPnrF7C2HmdnV6QZcEbzWoWiBYEnLerjQ99zWpBng!-145788764


这两种方式对于用户来说是没有区别的，只是服务器在解析的时候处理的方式不同，采用第一种方式也有利于把sessionid的信息和正常程序参数区分开来。

为了在整个交互过程中始终保持状态，就必须在每个客户端可能请求的路径后面都包含这个sessionid。

另一种技术叫做表单隐藏字段。就是服务器会自动修改表单，添加一个隐藏字段，以便在表单提交时能够把sessionid传递回服务器。比如下面的表单

在被传递给客户端之前将被改写成这种技术现在已较少应用，笔者接触过的很古老的iPlanet6(SunONE应用服务器的前身)就使用了这种技术。

实际上这种技术可以简单的用对action应用URL重写来代替。

在谈论session机制的时候，常常听到这样一种误解“只要关闭浏览器，session就消失了”。其实可以想象一下会员卡的例子，除非顾客主动对店家提出销卡，否则店家绝对不会轻易删除顾客的资料。对session来说也是一样的，除非程序通知服务器删除一个session，否则服务器会一直保留，程序一般都是在用户做logoff的时候发个指令去删除session。然而浏览器从来不会主动在关闭之前通知服务器它将要关闭，因此服务器根本不会有机会知道浏览器已经关闭，之所以会有这种错觉，是大部分session机制都使用会话cookie来保存sessionid，而关闭浏览器后这个sessionid就消失了，再次连接服务器时也就无法找到原来的session。如果服务器设置的cookie被保存到硬盘上，或者使用某种手段改写浏览器发出的HTTP请求头，把原来的sessionid发送给服务器，则再次打开浏览器仍然能够找到原来的session。

恰恰是由于关闭浏览器不会导致session被删除，迫使服务器为seesion设置了一个失效时间，当距离客户端上一次使用session的时间超过这个失效时间时，服务器就可以认为客户端已经停止了活动，才会把session删除以节省存储空间。

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

## 由JSESSIONID谈cookie与SESSION的区别和联系 ##

在一些投票之类的场合，我们往往因为公平的原则要求每人只能投一票，在一些WEB开发中也有类似的情况，这时候我们通常会使用COOKIE来实现，例如如下的代码：

 

	<%
	cookie[]cookies=request.getCookies();  
	if(cookies.lenght==0||cookies==null)  
		doStuffForNewbie();  
		//没有访问过  
	}else {  
		doStuffForReturnVisitor();//已经访问过了  
	}  
	%>
 

这是很浅显易懂的道理，检测COOKIE的存在，如果存在说明已经运行过写入COOKIE的代码了，然而运行以上的代码后，无论何时结果都是执行doStuffForReturnVisitor()，通过控制面板-Internet选项-设置-察看文件却始终看不到生成的cookie文件，奇怪，代码明明没有问题，不过既然有cookie，那就显示出来看看。

 

	cookie[]cookies=request.getCookies();  
	if(cookies.lenght==0||cookies==null)  
		out.println("Hasnotvisitedthiswebsite");  
	 } else {  
		for(inti=0;i<cookie.length;i++){  
			out.println("cookiename:"+cookies[i].getName()+"cookievalue:"+  
			cookie[i].getValue());  
		}  
	}  

运行结果:

	cookiename:JSESSIONIDcookievalue:KWJHUG6JJM65HS2K6

为什么会有cookie呢,大家都知道，http是无状态的协议，客户每次读取web页面时，服务器都打开新的会话，而且服务器也不会自动维护客户的上下文信息，那么要怎么才能实现网上商店中的购物车呢，session就是一种保存上下文信息的机制，它是针对每一个用户的，变量的值保存在服务器端，通过SessionID来区分不同的客户,session是以cookie或URL重写为基础的，默认使用cookie来实现，系统会创造一个名为JSESSIONID的输出cookie，我们叫做sessioncookie,以区别persistentcookies,也就是我们通常所说的cookie,注意sessioncookie是存储于浏览器内存中的，并不是写到硬盘上的，这也就是我们刚才看到的JSESSIONID，我们通常情是看不到JSESSIONID的，但是当我们把浏览器的cookie禁止后，web服务器会采用URL重写的方式传递Sessionid，我们就可以在地址栏看到sessionid=KWJHUG6JJM65HS2K6之类的字符串。

明白了原理，我们就可以很容易的分辨出persistentcookies和sessioncookie的区别了，网上那些关于两者安全性的讨论也就一目了然了，sessioncookie针对某一次会话而言，会话结束sessioncookie也就随着消失了，而persistentcookie只是存在于客户端硬盘上的一段文本（通常是加密的），而且可能会遭到cookie欺骗以及针对cookie的跨站脚本攻击，自然不如sessioncookie安全了。

通常sessioncookie是不能跨窗口使用的，当你新开了一个浏览器窗口进入相同页面时，系统会赋予你一个新的sessionid，这样我们信息共享的目的就达不到了，此时我们可以先把sessionid保存在persistentcookie中，然后在新窗口中读出来，就可以得到上一个窗口SessionID了，这样通过sessioncookie和persistentcookie的结合我们就实现了跨窗口的sessiontracking（会话跟踪）。

在一些web开发的书中，往往只是简单的把Session和cookie作为两种并列的http传送信息的方式，sessioncookies位于服务器端，persistentcookie位于客户端，可是session又是以cookie为基础的，明白的两者之间的联系和区别，我们就不难选择合适的技术来开发webservice了。

后来我看一篇关于 彻底理解PHP的SESSION机制

		1.session.save_handler = files

* 1.session_start()

1. session_start()是session机制的开始，它有一定概率开启垃圾回收,因为session是存放在文件中，PHP自身的垃圾回收是无效的，SESSION的回收是要删文件的，这个概率是根据php.ini的配置决定的，但是有的系统是 session.gc_probability = 0，这也就是说概率是0，而是通过cron脚本来实现垃圾回收。

            session.gc_probability = 1
            session.gc_divisor = 1000
            session.gc_maxlifetime = 1440//过期时间 默认24分钟
            //概率是 session.gc_probability/session.gc_divisor 结果 1/1000, 
            //不建议设置过小，因为session的垃圾回收，是需要检查每个文件是否过期的。
            session.save_path = //好像不同的系统默认不一样，有一种设置是 "N;/path"
            //这是随机分级存储，这个样的话，垃圾回收将不起作用，需要自己写脚本

2. session会判断当前是否有$_COOKIE[session_name()];session_name()返回保存session_id的COOKIE键值，这个值可以从php.ini找到

            session.name = PHPSESSID //默认值PHPSESSID
            

3. 如果不存在会生成一个session_id,然后把生成的session_id作为COOKIE的值传递到客户端.相当于执行了下面COOKIE 操作，注意的是，这一步执行了setcookie()操作，COOKIE是在header头中发送的，这之前是不能有输出的，PHP有另外一个函数 session_regenerate_id() 如果使用这个函数，这之前也是不能有输出的。

                setcookie(session_name(),
                          session_id(),
                          session.cookie_lifetime,//默认0
                          session.cookie_path,//默认'/'当前程序跟目录下都有效
                          session.cookie_domain,//默认为空
                          )

4. 如果存在那么session_id = $_COOKIE[session_name];然后去session.save_path指定的文件夹里去找名字为'SESS_' . session_id()的文件.读取文件的内容反序列化，然后放到$_SESSION中
* 2. 为$_SESSION赋值比如新添加一个值$_SESSION['test'] = 'blah'; 那么这个$_SESSION只会维护在内存中，当脚本执行结束的时候，用把$_SESSION的值写入到session_id指定的文件夹中，然后关闭相关资源. 这个阶段有可能执行更改session_id的操作，比如销毁一个旧的的session_id，生成一个全新的session_id.一半用在自定义 session操作，角色的转换上，比如Drupal.Drupal的匿名用户有一个SESSION的，当它登录后需要换用新的session_id

        if (isset($_COOKIE[session_name()])) {
          setcookie(session_name(), '', time() - 42000, '/');//旧session cookie过期
        }
        session_regenerate_id();//这一步会生成新的session_id
       //session_id()返回的是新的值

* 3. 写入SESSION操作
   在脚本结束的时候会执行SESSION写入操作，把$_SESSION中值写入到session_id命名的文件中，可能已经存在，可能需要创建新的文件。
 * 4. 销毁SESSION
   SESSION发出去的COOKIE一般属于即时COOKIE，保存在内存中，当浏览器关闭后，才会过期，假如需要人为强制过期，比如 退出登录，而不是关闭浏览器，那么就需要在代码里销毁SESSION，方法有很多，

          o 1. setcookie(session_name(), session_id(), time() - 8000000, ..);//退出登录前执行
          o 2. usset($_SESSION);//这会删除所有的$_SESSION数据，刷新后，有COOKIE传过来，但是没有数据。
          o 3. session_destroy();//这个作用更彻底，删除$_SESSION 删除session文件，和session_id

  当不关闭浏览器的情况下，再次刷新，2和3都会有COOKIE传过来，但是找不到数据

2.session.save_handler = user

 用户自定义session处理机制，更加直

 session_set_save_handler('open', 'close', 'read', 'write', 'destroy', 'gc'); 
1.session_start(),

  执行open($save_path, $session_name)打开session操作句柄
  $save_path 在session.save_handler = files的情况下它就是session.save_path，
但是如果用户自定的话，这个两个参数都用不上，直接返回TRUE

      执行read($id)从中读取数据.//这个参数是自动传递的就是session_id(),可以通过这个值进行操作。

2.脚本执行结束

      执行write($id, $sess_data) //两个参数，很简单

3.假如用户需要session_destroy()
先执行destroy.在执行第2步

一个实际例子：代码如下 	 

      //SESSION初始化的时候调用
      function open($save_path, $session_name){
	        global $sess_save_path;
	        $sess_save_path = $save_path;
	        return(true);
      }

      //关闭的时候调用
      function close(){
          return(true);
      }

      function read($id){
         global $sess_save_path;
         $sess_file = "$sess_save_path/sess_$id";
         return (string) @file_get_contents($sess_file);
      }
      //脚本执行结束之前，执行写入操作
      function write($id, $sess_data){
         echo "sdfsf";
         global $sess_save_path;
         $sess_file = "$sess_save_path/sess_$id";
         if ($fp = @fopen($sess_file, "w")) {
            $return = fwrite($fp, $sess_data);
            fclose($fp);
            return $return;
         } else {
            return(false);
         }

      }

      function destroy($id){
          global $sess_save_path;

          $sess_file = "$sess_save_path/sess_$id";
          return(@unlink($sess_file));
      }

      function gc($maxlifetime) {
          global $sess_save_path;

         foreach (glob("$sess_save_path/sess_*") as $filename) {
           if (filemtime($filename) + $maxlifetime < time()) {
              @unlink($filename);
           }
         }
         return true;
      }