<?php 
    require_once __DIR__."/../../core/init.php";
    $open = "admin";
    $title = "Thêm mới admin - XP Shop";
    $ten_admin = $db->fetch_id("admin",@$_SESSION['id']);
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
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
            "password" => md5(postInput("password")),
            "address" => postInput("address"),
            "level" => postInput("level")
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
            $mail = $db->fetch_one("SELECT * FROM admin WHERE email = '$data[email]'");
            if($mail != NULL)
            {
                $error["mail"] = "Email của bạn đã tồn tại";
            }
        }
        if(postInput("phone") == "")
        {
            $error["phone"] = "Mời bạn nhập đầy đủ phone";
        }
        if(postInput("password") == "")
        {
            $error["password"] = "Mời bạn nhập đầy đủ password";
        }
        if(postInput("config_password") == "")
        {
            $error["config_password"] = "Mời bạn nhập đầy đủ config password";
        }
        if(postInput("address") == "")
        {
            $error["address"] = "Mời bạn nhập đầy đủ address";
        }
        if(postInput("level") == -1)
        {
            $error["level"] = "Mời bạn nhập đầy đủ level";
        }
        if(md5(postInput('password')) != md5(postInput('config_password')))
        {
            $error["config_password"] = "Mật khẩu nhập lại không khớp";
        }
        

        // insert vào
        if(empty($error))
        {
            $id_insert_last = $db->insert("admin",$data);
            if(@$id_insert_last)
            {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_admin('admin');
            }
            else
            {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        }
    }
?>
<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Thêm mới admin
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
                                <input type="text" class="form-control" placeholder="Họ và tên" name="name_admin" value="<?php echo @$data['name']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["name"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="mail" placeholder="Email" value="<?php echo @$data['email']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["mail"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="phone" placeholder="01215 300 516" value="<?php echo @$data['phone']; ?>">
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
                                <input type="text" class="form-control" name="address" placeholder="Điện Bàn, Quảng Nam" value="<?php echo @$data['address']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["address"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-8">
                                <select name="level" class="form-control">
                                    <option value="-1">-- Chọn Level --</option>
                                    <option value="1" <?php echo (isset($data['level']) && @$data['level'] == 1)?'selected="selected"':''; ?>>ADMIN</option>
                                    <option value="2" <?php echo (isset($data['level']) && @$data['level'] == 2)?'selected="selected"':''; ?>>MEMBER</option>
                                </select>
                                <span style="color: red;font-style: italic;"><?php echo @$error["level"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

<?php require_once __DIR__."/../../includes/footer.php"; ?>