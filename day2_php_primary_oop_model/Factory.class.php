<?php
class Factory{
    static public function getImage($_path){
        $_file=pathinfo($_path);
        switch ($_file['extension']){
            case 'png':
                return new Png();
                break;
            case 'jpg':
                return new Jpeg();
                break;
            case 'gif':
                return new Gif();
                break;
        }
    }
}
?>