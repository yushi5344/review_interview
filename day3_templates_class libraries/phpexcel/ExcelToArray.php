<?php
class ExcelToArray{
	public $type =null;
	public function __construct($file_type) {
     /*导入phpExcel核心类   */
     include_once('./PHPExcel/PHPExcel.php');
	$this->type = $file_type;
 }
/**
* 读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8
*以下基本都不要修改
*/
	public function read($filename,$encode='utf-8'){
	//判断上传文件类型  选择合适的类库文件  xls->excel5 ,xlsx->excel2007
		if($this->type=="xls") 
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
		else
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($filename);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow(); 
		$highestColumn = $objWorksheet->getHighestColumn(); 
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
		$excelData = array(); 
		for ($row = 1; $row <= $highestRow; $row++) { 
			for ($col = 0; $col < $highestColumnIndex; $col++) { 
				$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			} 
		} 
		return $excelData;
	}    
}