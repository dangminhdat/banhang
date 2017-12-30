<?php
    error_reporting(0);
	  session_start();
    require_once __DIR__.'/../../libraries/database.php';
    require_once __DIR__.'/../../libraries/function.php';
 
    $db = new database();

   	define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/public/uploads/");

  	/*
  	*	tổng danh mục sản phẩm
  	*/	
  	$count_danhmuc = $db->total_data("SELECT * FROM chuyenmuc");

  	/*
  	*	tổng sản phẩm
  	*/	
  	$count_sanpham = $db->total_data("SELECT * FROM sanpham");

  	/*
  	*	tổng đơn hàng
  	*/	
  	$count_giaodich = $db->total_data("SELECT * FROM giaodich");

  	/*
  	*	tổng admin
  	*/	
  	$count_admin = $db->total_data("SELECT * FROM admin");
?>