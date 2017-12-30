<?php 
    require __DIR__."/core/init.php";
    if(isset($_SESSION['id']) || isset($_SESSION['id']) || isset($_SESSION['name']))
    {
        header('Location: '.base_url().'admin');
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = postInput("email");
        $pass = postInput("password");

        if($email == '' || $pass == '')
        {
            $error = "Nhập đầy đủ thông tin";
        }
        else
        {
            $admin = $db->fetch_one("SELECT * FROM admin WHERE email = '$email'");
            if(!$admin)
            {
                $error = "Email không tồn tại";
            }
            else
            {
                if(md5($pass) != $admin['password'])
                {
                    $error = "Mật khẩu không chính xác";
                }
                else
                {
                    echo "<script>alert('Đăng nhập thành công');</script>";
                    $_SESSION['id'] = $admin['id'];
                    $_SESSION['name'] = $admin['name'];
                    $_SESSION['email'] = $admin['email'];
                    $_SESSION['status'] = $admin['status'];
                    $_SESSION['level'] = $admin['level'];
                    if(postInput('remember-me'))
                    {
                        setcookie("username-remember",$email,time()+(10 * 365 * 24 * 60 * 60));
                        setcookie("password-remember",$pass,time()+(10 * 365 * 24 * 60 * 60));
                    }
                    else
                    {
                        setcookie("username-remember","");
                        setcookie("password-remember","");
                    }
                    echo "<script> location.href = '".base_url()."admin/';</script>";
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản trị trang bán hàng - XP</title>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/admin/vendor/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>public/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>public/admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>public/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>public/admin/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Trang quản trị bán hàng online XP</a>
            </div>
        </nav>
       
        

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đăng nhập</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <span style="color: red;font-style: italic;display: block;margin: 0 0 15px"><?php echo (@$error)?$error:"Vui lòng điền đăng nhập trước" ?></span>
            <div class="row">
                <form method="POST" action="" class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" value="<?php echo @$_COOKIE['username-remember']; ?>" name="email" placeholder="Email">
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="password" value="<?php echo @$_COOKIE['password-remember']; ?>" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <div class="form-group">    
                        <input type="checkbox" name="remember-me" <?php echo (@$_COOKIE['username-remember'])?'checked="checked"':''; ?>> Remember Me
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>  
                    </div>
                </form>
            </div>
            <!-- /.row -->
            
        
        </div>
        <!-- /#page-wrapper -->

<?php require_once __DIR__."/includes/footer.php"; ?>