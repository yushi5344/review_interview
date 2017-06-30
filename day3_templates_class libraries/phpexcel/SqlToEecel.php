<?php
	class SqlToEecel {
	       public function __construct() {
		      /*导入phpExcel核心类    注意 ：你的路径跟我不一样就不能直接复制*/
		       include_once('./PHPExcel/PHPExcel.php');
	       }
	     /* 导出excel函数*/
	    public function push($data,$name='Excel'){
		  //error_reporting(E_ALL);
		  //date_default_timezone_set('Europe/London');
		 $objPHPExcel = new PHPExcel();
		/*以下是一些设置 ，什么作者  标题啊之类的*/
		 $objPHPExcel->getProperties()->setCreator("漠")
				       ->setLastModifiedBy("漠")
				       ->setTitle("数据EXCEL导出")
				       ->setSubject("数据EXCEL导出")
				       ->setDescription("备份数据")
				       ->setKeywords("excel")
				      ->setCategory("result file");
		 /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/

		$objPHPExcel->setActiveSheetIndex(0)
				 //设置第一行的显示信息
				  ->setCellValue('A1', "id")    
				  ->setCellValue('B1', "url")
				  ->setCellValue('C1', "标题")
				  ->setCellValue('D1', "类型");
		foreach($data as $k => $v){
		     $num=$k+2;
		     $objPHPExcel->setActiveSheetIndex(0)
				 //Excel的第A列，uid是你查出数组的键值，下面以此类推
				  ->setCellValue('A'.$num, $v['lid'])    
				  ->setCellValue('B'.$num, $v['link_url'])
				  ->setCellValue('C'.$num, $v['link_title'])
				  ->setCellValue('D'.$num, $v['type']);
		    }
		    $objPHPExcel->getActiveSheet()->setTitle('User');
		    $objPHPExcel->setActiveSheetIndex(0);
		     header('Content-Type: application/vnd.ms-excel');
		     header('Content-Disposition: attachment;filename="'.$name.'.xls"');
		     header('Cache-Control: max-age=0');
		     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		     $objWriter->save('php://output');
		     exit;
	      }
}