<?php 
	require __DIR__.'/../../core/init.php';
	$action = postInput("action");
	if($action == 'status_admin')
	{
		$id = postInput("id");
		$admin = $db->fetch_one("SELECT * FROM admin WHERE id = $id");
		$status = ($admin['status'] == 1)?0:1;
		$db->update("admin",array("status"=>$status),array("id"=>$id));
		echo ($status == 1)?"Hoạt động":"Khóa";
	}
?>