<?php 
	require_once __DIR__."/../../core/init.php";
    $open = "chuyenmuc";

    $id = intval(getInput('id'));

    $editChuyenmuc = $db->fetch_id('chuyenmuc',$id);

    if(empty($editChuyenmuc))
    {
        $_SESSION['error'] = 'Dữ liệu không tồn tại';
        redirect_admin('chuyenmuc');
    }
    $ten_admin = $db->fetch_id("admin",@$_SESSION['id']);
    if($ten_admin['level'] == 2)
    {
        $_SESSION['error'] = 'Bạn không đủ quyền xóa';
        redirect_admin('chuyenmuc');
    }
    $kiem_tra = $db->fetch_one("SELECT * FROM sanpham WHERE parent_id = $id || chuyenmuc_con = $id");
    if($kiem_tra == NULL)
    {
        $id_delete = $db->delete('chuyenmuc',$id);
        if($id_delete > 0)
        {
            $_SESSION['success'] = "Xóa thành công";
            redirect_admin('chuyenmuc');
        }
        else
        {
            $_SESSION['error'] = "Xóa thất bại";
            redirect_admin('chuyenmuc');
        }
    }
    else
    {
        $_SESSION['error'] = "Danh mục của bạn không được xóa";
        redirect_admin("chuyenmuc");
    }   
?>