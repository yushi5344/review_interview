<?php
include 'Jpeg.class.php';
include 'Gif.class.php';
include 'Png.class.php';
include 'Factory.class.php';
$factory=new Factory();
$a=$factory::getImage('./img/1.jpg');
$a->getHeight();
?>