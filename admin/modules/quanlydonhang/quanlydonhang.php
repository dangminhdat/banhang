<?php 
	require __DIR__."/../../core/init.php";
	$action = postInput("action");
	if($action == "apply_status")
	{
		$id = postInput("id");
		$giaodich = $db->fetch_one("SELECT * FROM giaodich WHERE taikhoan_id = $id");
		$value = ($giaodich['status'] == 0)?1:0;
		$update = $db->updateview("UPDATE giaodich SET status = $value WHERE taikhoan_id = $id");
		echo ($value == 1)?"Đã giao":"Chưa giao";
	}
?>