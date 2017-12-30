<?php 
    require_once __DIR__."/../../core/init.php";
    $open = "admin";
    $title = "Chỉnh sủa admin - XP Shop";
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    $id = intval(getInput('id'));
    $editAdmin = $db->fetch_id("admin",$id);

    if($editAdmin == NULL)
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirect_admin("admin");
    }
    $ten_admin = $db->fetch_id("admin",@$_SESSION['id']);
    if($ten_admin['level'] == 2)
    {
        $_SESSION['error'] = 'Bạn không đủ quyền sửa';
        redirect_admin('admin');
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = array(
            "name" => postInput("name_admin"),
            "email" => postInput("mail"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "level" => postInput("level")
            );
        $dieukien = array(
            "id" => $id
            );
        $error = [];

        $kiem_tra = $db->fetch_one("SELECT * FROM chuyenmuc WHERE name = '".postInput("add_danh_muc")."'");

        if(postInput("name_admin") == "")
        {
            $error["name"] = "Mời bạn nhập đầy đủ họ và tên";
        }
        if(postInput("mail") == "")
        {
            $error["mail"] = "Mời bạn nhập đầy đủ email";
        }
        else
        {
            // $sql = "SELECT * FROM admin WHERE email != '$editAdmin[email]' AND email = '".postInput('mail')."'";
            // $mail = $db->fetch_one($sql);
            if($editAdmin['email'] != postInput('mail'))
            {
                $mail = $db->fetch_one("SELECT * FROM admin WHERE email = '".postInput('mail')."'");
                if($mail != NULL)
                {
                    $error["mail"] = "Email của bạn đã tồn tại";
                }
            }
        }
        if(postInput("phone") == "")
        {
            $error["phone"] = "Mời bạn nhập đầy đủ phone";
        }
        if(postInput("address") == "")
        {
            $error["address"] = "Mời bạn nhập đầy đủ address";
        }
        if(postInput("level") == -1)
        {
            $error["level"] = "Mời bạn nhập đầy đủ level";
        }
        if(postInput("password") != "" && postInput("config_password") != "")
        {
            if(md5(postInput('password')) != md5(postInput('config_password')))
            {
                $error["config_password"] = "Mật khẩu nhập lại không khớp";
            }
            else
            {
                $data['password'] = md5(postInput('password'));
            }
        }     

        // insert vào
        if(empty($error))
        {
            $id_update_last = $db->update("admin",$data,$dieukien);
            if($id_update_last > 0)
            {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_admin('admin');
            }
            else
            {
                $_SESSION['error'] = "Cập nhật thất bại";
                redirect_admin('admin');
            }
        }
    }
?>
<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Chỉnh sửa admin
                        <a href="./" class="btn btn-success"><span class="fa fa-arrow-left"></span> Trở về</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-user"></i> admin
                        </li>
                        <li>
                            <i class="fa fa-plus"></i> Thêm mới
                        </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ và tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Họ và tên" name="name_admin" value="<?php echo @$editAdmin['name']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["name"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="mail" placeholder="Email" value="<?php echo @$editAdmin['email']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["mail"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="phone" placeholder="01215 300 516" value="<?php echo @$editAdmin['phone']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["phone"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <span style="color: red;font-style: italic;"><?php echo @$error["password"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Config Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="config_password" placeholder="Config Password">
                                <span style="color: red;font-style: italic;"><?php echo @$error["config_password"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address" placeholder="Điện Bàn, Quảng Nam" value="<?php echo @$editAdmin['address']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["address"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-8">
                                <select name="level" class="form-control">
                                    <option value="-1">-- Chọn Level --</option>
                                    <option value="1" <?php echo (isset($editAdmin['level']) && @$editAdmin['level'] == 1)?'selected="selected"':''; ?>>ADMIN</option>
                                    <option value="2" <?php echo (isset($editAdmin['level']) && @$editAdmin['level'] == 2)?'selected="selected"':''; ?>>MEMBER</option>
                                </select>
                                <span style="color: red;font-style: italic;"><?php echo @$error["level"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

<?php require_once __DIR__."/../../includes/footer.php"; ?>