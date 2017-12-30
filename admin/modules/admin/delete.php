<?php 
	require __DIR__."/../../core/init.php";
	$open = "admin";

	$id = intval(getInput("id"));
	$admin = $db->fetch_id("admin",$id);

	if($admin == NULL)
	{
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirect_admin("admin");
	}
	if($admin['level'] == 1)
	{
		$_SESSION['error'] = "Không thể xóa admin";
		redirect_admin("admin");
	}
	$ten_admin = $db->fetch_id("admin",@$_SESSION['id']);
    if($ten_admin['level'] == 2)
    {
        $_SESSION['error'] = 'Bạn không đủ quyền xóa';
        redirect_admin('admin');
    }
	$delete_id = $db->delete("admin",$id);
	if($delete_id > 0)
	{
		$_SESSION['success'] = "Xóa thành công";
		redirect_admin("admin");
	}
	else
	{
		$_SESSION['error'] = "Xóa thất bại";
		redirect_admin("admin");	
	}


?>