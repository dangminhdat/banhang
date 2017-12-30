<?php 
	require __DIR__.'/../../core/init.php';

	@$status = (postInput("status") == 1)? 0 : 1;
	@$home = (postInput("home") == 1)? 0 : 1;
	$id = postInput("id");

	$count = $db->updateview("UPDATE chuyenmuc SET status = $status,home = $home WHERE id = $id");
	if(@$count > 0)
	{
		$_SESSION['success'] = "Thành công";
	}
	else
	{
		$_SESSION['error'] = "Thất bại";
	}
?>