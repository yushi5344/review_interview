# jQuery是什么 #
jQuery是现今最流行的JavaScript库，开发者可以借助其实现常见任务的自动化和复杂任务的简单化。
## jQuery能做什么 ##

- 获取页面的元素：丰富的选择符机制
- 修改页面的外观：提供跨浏览器的标准化解决方案
- 改变页面的内容：提供了截取形形色色的页面时间的适当方式
- 为页面增加动态效果：内置的效果包
- 无需提交页面从服务器获取数据  ajax
- 简化常见的js任务

## jquery+ajax三级联动获取省市区 ##

three.html页面代码：

	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Document</title>
		<script type="text/javascript" src="../jquery-3.2.1.js"></script>
		<script type="text/javascript" src="three.js"></script>
		<link rel="stylesheet" href="three.css" />
	</head>
	<body>
	    <form action="">
	    	<select name="province" id="province"></select>省
	    	<select name="city" id="city"></select>市
	    	<select name="area" id="area"></select>
	    </form>
	</body>
	</html>

three.js页面代码：

	$(function () {
	
	    /*获取初始省份*/
	    fid=1;
	    threeChange(fid,'#province');
	
	    /*获取初始市*/
	    fid=$('select[name=province]').val();
	    threeChange(fid,'#city');
	
	     /*获取初始县区*/
	    fid=$('select[name=city]').val();
	    threeChange(fid,'#area');
	
	
	     /*省份联动市、县区*/
	    $('#province').change(function () {
	        fid=$(this).val();
	        threeChange(fid,'#city');
	        fid=$('#city').val();
	        threeChange(fid,'#area');
	
	    });
	
	    /*市联动县区*/
	    $('#city').change(function() {
	        fid=$(this).val();
	        threeChange(fid,'#area');
	    });
	
	});

	function threeChange(fid,ids){
	    $.ajax({
	          type:'POST',
	          url:'do_three.php',
	          data:{fid:fid},
	          async:false,
	          success:function(response){
	                jsn=$.parseJSON(response);//把json字符串变成json对象
	                $(ids).empty();
	                $.each(jsn, function(k, v) {
	                    $(ids).append("<option value="+k+">"+v+"</option>");
	               });
	          }
	    });
	}


three.php页面代码：

	<?php
		try {
		    $_drive_opt=array(
		        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
		        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
		    );
		    $_pdo=new PDO('mysql:host=localhost;dbname=think','root','921256054',$_drive_opt);
		} catch (PDOException $e) {
		    exit('数据库连接失败'.$e->getMessage());
		}
		
		if (isset($_POST['fid'])){
		    $_sql="SELECT id,name FROM area WHERE fid='{$_POST['fid']}'";
		    $_stmt=$_pdo->query($_sql,PDO::FETCH_ASSOC);
		    $_a=array();
		    $_a=$_stmt->fetchAll();
		    $_name=array_column($_a, 'name','id');//把二维数组变成一维数组
		    $_json=json_encode($_name,JSON_UNESCAPED_UNICODE);//把数组变成json字符串
		    echo $_json;
		}
	
	?>

## jQuery+ajax跨域请求 ##

第一个域www.web1.com  

index.html页面代码：

	//index.html
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<script type="text/javascript" src="jquery1.8.3.js"></script>
		<title>web1</title>
	</head>
	<body>
	<button>获取web2</button>
	<div></div>
	</body>
	$(function(){
    	$('button').click(function () {
	        $.ajax({
	            type:'POST',
	            url:'http://www.web2.com?callback=?',
	            dataType:'jsonp',
	            success:function(response,status,xhr){
	                $.each(response, function(k, v) {
	                  $('div').append(k+'=>'+v);
	                });
	            }
	        });
    	});
	});
	</html>


第二个域www.web2.com

index.php页面代码

	<?php
		$_arr=array('a'=>1,'b'=>2,'c'=>3);
		$_result=json_encode($_arr);
		$_callback=$_GET['callback'];
		echo $_callback."($_result)";
	?>