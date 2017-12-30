<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>admin">Trang quản trị bán hàng online XP</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- thông báo -->
                <li>
                    <a href="<?php echo base_url(); ?>">Đến trang website</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Xin chào <?php echo @$_SESSION['name']; ?> <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-message">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</a></li>
                        <li><a><i class="fa fa-upload fa-fw"></i> Ảnh đại diện
                            <form action="" method="post">
                                <input type="file" accept="image/*" id="avatar">
                            </form>
                            <!-- <script>
                                $('#avatar').on("change",function(){
                                    e.preventDefault();
                                    count = $('#avatar').get(0).files.length;
                                    for (var i = 0; i <= count_img_up - 1; i++) {
                                        size_img = $('#img_up').get(0).files[i].size;
                                        if(size_img > 5242880) //5MB
                                        {
                                            size_error += 1;
                                        }
                                        else
                                        {
                                            size_error += 0;
                                        }   
                                    }
                                    for (var i = 0; i <= count_img_up - 1; i++) {
                                        type_img = $('#img_up').get(0).files[i].type;
                                        if(type_img == 'image/gif' || type_img == 'image/jpeg' || type_img == 'image/png') //5MB
                                        {
                                            type_error += 0;
                                        }
                                        else
                                        {
                                            type_error += 1;
                                        }   
                                    }

                                    if(size_error >= 1)
                                    {
                                        $('#formUpload .alert').removeClass('hidden');
                                        $('#formUpload .alert').html('Error: Một trong các tệp đã chọn có dung lượng lớn hơn mức cho phép.');
                                        $this.html('Upload');
                                    }
                                    else if(type_error >= 1)
                                    {
                                        $('#formUpload .alert').removeClass('hidden');
                                        $('#formUpload .alert').html('Error: Một trong những file ảnh không đúng định dạng cho phép.');
                                        $this.html('Upload');
                                    }
                                    else if(count_img_up > 20)
                                    {
                                        $('#formUpload .alert').removeClass('hidden');
                                        $('#formUpload .alert').html('Error: Số file upload cho mỗi lần vượt quá mức cho phép.');
                                        $this.html('Upload');
                                    }
                                    else
                                    {
                                        $(this).ajaxSubmit({
                                            beforeSubmit : function(){
                                                target : '#formUpload .alert',
                                                $('#formUpload .box_progress').removeClass('hidden');
                                                $('#formUpload .progress-bar').width('0%');
                                            },
                                            uploadProgress : function (event, position, total, percentComplete){ 
                                                $("#formUpload .progress-bar").animate({width: percentComplete + '%'});
                                                $("#formUpload .progress-bar").html(percentComplete + '%');
                                            },
                                            success : function(data){
                                                $('#formUpload .alert').attr('class','alert alert-success');
                                                $('#formUpload .alert').html(data);
                                                $this.html("Upload");
                                            },
                                            error : function(){
                                                $('#formUpload .alert').removeClass('hidden');
                                                $('#formUpload .alert').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                                                $this.html("Upload");
                                            },
                                            resetForm : true 
                                        });
                                        return false;
                                    }
                                })
                            </script> -->
                        </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="media">
                            <?php 
                                $ten_admin = $db->fetch_id("admin",$_SESSION['id']);
                            ?>
                            <div class="media-left">
                                <?php if($ten_admin['avatar'] == '') { ?>
                                <img src="<?php echo uploads(); ?>admin/user.jpg" alt="" width="80" height="80">
                                <?php }else{ ?>
                                <img src="<?php echo uploads(); ?>admin/<?php echo $ten_admin['avatar']; ?>" alt="" width="80" height="80">
                                <?php } ?>
                            </div>
                            <div class="media-body">
                                <h4><?php echo $ten_admin['name']; ?></h4>
                                <span class="label <?php echo ($ten_admin['level'] == 1)?"label-primary":"label-success"; ?>"><?php echo ($ten_admin['level'] == 1)?"Quản trị viên":"Thành viên"; ?></span>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
                        </li>
                        <li class="<?php echo (isset($open) && $open == 'chuyenmuc')?'active':''; ?>">
                            <a href="<?php echo modules('chuyenmuc'); ?>"><i class="fa fa-list fa-fw"></i> Danh mục sản phẩm</a>
                        </li>
                        <li class="<?php echo (isset($open) && $open == 'sanpham')?'active':''; ?>">
                            <a href="<?php echo modules('sanpham'); ?>"><i class="fa fa-database fa-fw"></i> Sản phẩm</a>
                        </li>
                        <li class="<?php echo (isset($open) && $open == 'quanlydonhang')?'active':''; ?>">
                            <a href="<?php echo modules('quanlydonhang'); ?>"><i class="fa fa-shopping-cart fa-fw"></i> Quản lý đơn hàng</a>
                        </li>
                        <li class="<?php echo (isset($open) && $open == 'admin')?'active':''; ?>">
                            <a href="<?php echo modules('admin'); ?>"><i class="fa fa-user fa-fw"></i> ADMIN</a>
                        </li>
                        <li class="<?php echo (isset($open) && $open == 'setting')?'active':''; ?>">
                            <a href="<?php echo modules('setting'); ?>"><i class="fa fa-cog fa-fw"></i> Cài đặt chung</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        