<?php
	header("content-type:text/html;charset=utf-8");
	date_default_timezone_set("PRC");
	include './SqlToEecel.php';
	$pdo = new PDO("mysql:host=localhost;dbname=wepiao","root","root");
	$pdo->exec("set names utf8");
	$data=$pdo->query("select * from wp_link")->fetchAll();   //查出数据
	

	$name='Excelfile';    //生成的Excel文件文件名
	$Excel = new  SqlToEecel();
	$res=$Excel->push($data,$name);