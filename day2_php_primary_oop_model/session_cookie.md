# cookie应用 #
创建cookie
 
	setcookie('name','Lee',time()+60*60);

读取cookie

	echo $_COOKIE['name'];

删除cookie

	setcookie('name');

cookie限制 

	客户端使用，一个浏览器能创建的cookie最多30个，每个不能超过4KB，每个web站点最多不能超过20个。


# session会话 #
创建session

	session_start();
	$_SESSION['name']='Lee';
	echo $_SESSION['name'];

删除session

	unset($_SESSION['name']);

销毁所有session

	session_destroy();

上传控件

	<form action="upload.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="800000"/>
        上传文件：<input type="file" name="userfile"/>
        <input type="submit" value="上传"/>     
    </form>