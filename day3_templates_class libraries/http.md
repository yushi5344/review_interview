# thinkphp中的http下载类使用 #

	require_once 'include/Http.class.php';
    $down=new Http();
    $img=BASE_PATH.'/upload/1.jpg';
    $down::download($img);

注意：先要开启php.ini中的fileinfo配置项。

	extension=php_fileinfo.dll