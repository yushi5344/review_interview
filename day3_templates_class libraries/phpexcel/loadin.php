<?php
    header("content-type:text/html;charset=utf-8");
	error_reporting("E_WARNING");
	include "./ExcelToArray.php";
	function msg($msg,$url="./index.html"){
		echo "<script>
		    alert('$msg');
			location.href='$url';
		</script>";
	}
if (! empty ( $_FILES ['file'] ['name'] ))
 {
    $tmp_file = $_FILES ['file'] ['tmp_name'];
    $file_type = end(explode ( ".", $_FILES ['file'] ['name']));
     /*判别是不是.xls文件，判别是不是excel文件*/
     if (strtolower ( $file_type ) != "xls" && strtolower ( $file_type ) != "xlsx")              
    {
          msg( '不是Excel文件，重新上传' , './index.html');
		  	  die;
     }



	 $ExcelToArray = new ExcelToArray($file_type);
    /*设置上传路径*/
     $savePath = "./upload/";
    /*以时间来命名上传的文件*/
     $str = date ( 'Ymdhis' ); 
     $file_name = $str . "." . $file_type;
     /*是否上传成功*/
     if (! copy ( $tmp_file, $savePath . $file_name )) 
      {
          msg( '上传失败' );
      }

    /*
       *对上传的Excel数据进行处理生成编程数据,这个函数会在下面第三步的ExcelToArray类中
      注意：这里调用执行了第三步类里面的read函数，把Excel转化为数组并返回给$res,再进行数据库写入
    */
  $res =  $ExcelToArray->read ( $savePath . $file_name );
   /*
        重要代码 解决Thinkphp M、D方法不能调用的问题  
        如果在thinkphp中遇到M 、D方法失效时就加入下面一句代码
    */
   //spl_autoload_register ( array ('Think', 'autoload' ) );

   /*对生成的数组进行数据库的写入*/
   var_dump($res);
   die;
	/*
		后续就是对数组进行处理，将其插入数据库
	*/
}else{
	msg("请上传excel文件","./index.html");
}