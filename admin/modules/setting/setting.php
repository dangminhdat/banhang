<?php 
	require __DIR__.'/../../core/init.php';
	$action = postInput("action");
	if($action == "show_status")
	{
		$web = $db->fetch_one("SELECT * FROM website");
		$status = ($web['status'] == 0)?1:0;
		$update = $db->updateview("UPDATE website SET status = $status");
		echo ($status == 0)?"Đóng":"Mở";
	}
	else if($action == "edit_title")
	{
		$title = postInput("title");
		$update = $db->updateview("UPDATE website SET title = '$title'");
	}
	else if($action == "edit_keyword")
	{
		$keyword = postInput("keyword");
		$update = $db->updateview("UPDATE website SET keywords = '$keyword'");
	}
	else if($action == "edit_describ")
	{
		$describ = postInput("describ");
		$update = $db->updateview("UPDATE website SET describ = '$describ'");
	}
?>