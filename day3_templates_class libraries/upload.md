# 文件上传类 #

	require_once 'include/UploadFile.class.php';
    $upload=new UploadFile();
    $upload->upload('upload/');
    $arr= $upload->getUploadFileInfo();
    echo $arr[0]['savepath'].$arr[0]['savename'];//上传地址