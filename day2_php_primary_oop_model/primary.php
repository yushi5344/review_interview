<?php
date_default_timezone_set("PRC");
// is_numeric($var);
// $a=1234567890;
// $b=number_format($a,2,',','.');
// echo $b;
//$arr=array('1','2','3',array(1,2,3,4),'5','6');
// echo next($arr);
// print_r(each($arr));
// echo end($arr);
// echo prev($arr);
//print_r(array_count_values($arr));
// $dir=opendir(dirname(__DIR__));
// while (!!$file=readdir($dir)){
//     echo $file.'<br />';
// }
//echo htmlentities('<strong>我是吴祁！</strong>');
//echo htmlspecialchars('<strong>我是吴祁！</strong>');
//print_r(str_split('This is a Teacher!'));
//echo strstr('yc60.com@gmail.com','@');
//echo substr_replace('yc60.com@gmail.com','###',0,5);
//print_r(getdate());
//echo mktime(12,12,12,12,12,2017);
interface Computer{
    const NAME='LEE';
    public function run();
}

final class NoteBook implements Computer{
    public function run(){
        echo '实现了接口的方法';
    }
}

$note=new NoteBook();
$note->run();
?>
