<?php 
	require __DIR__."/../../core/init.php";
	$open = "sanpham";

	$id = intval(getInput("id"));

	$sanpham = $db->fetch_id("sanpham",$id);

	if(empty($sanpham))
	{
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirect_admin("sanpham");
	}
	$ten_admin = $db->fetch_id("admin",@$_SESSION['id']);
    if($ten_admin['level'] == 2)
    {
        $_SESSION['error'] = 'Bạn không đủ quyền xóa';
        redirect_admin('sanpham');
    }
	$delete = $db->delete("sanpham",$id);
	if($delete > 0)
	{
		$_SESSION['success'] = "Xóa thành công";
		redirect_admin("sanpham");
	}
	else
	{
		$_SESSION['error'] = "Xóa thất bại";
		redirect_admin("sanpham");
	}
?>