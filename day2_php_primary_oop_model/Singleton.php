<?php
include 'DB.class.php';
$db=DB::getInstance();
$_arr=$db->query("select * from wp_link");
print_r($_arr->fetch());
?>