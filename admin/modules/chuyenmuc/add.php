<?php 
    require_once __DIR__."/../../core/init.php";
    $open = "chuyenmuc";
    $title = "Thêm danh mục - XP Shop";
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    $danhmuc = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = 0");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = array(
            "name" => postInput("add_danh_muc"),
            "slug" => to_slug(postInput("add_danh_muc")),
            "id_parent" => postInput("id_parent"),
            "size" => postInput("size")
            );
        $error = [];

        $kiem_tra = $db->fetch_one("SELECT * FROM chuyenmuc WHERE name = '".postInput("add_danh_muc")."'");

        if(postInput("add_danh_muc") == "")
        {
            $error["name"] = "Mời bạn nhập đầy đủ tên danh mục";
        }
        else if(count($kiem_tra) > 0)
        {
            $error["name"] = "Danh mục đã tồn tại";
        }
        if(postInput("size") == "")
        {
            $error["size"] = "Mời bạn nhập size";
        }

        // insert vào
        if(empty($error))
        {
            $id_insert_last = $db->insert("chuyenmuc",$data);
            if(@$id_insert_last)
            {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_admin('chuyenmuc');
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
                        Thêm mới danh mục
                        <a href="./" class="btn btn-success"><span class="fa fa-arrow-left"></span> Trở về</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-file"></i> Danh mục
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
                            <label class="col-sm-2 control-label">Tên danh mục</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Tên danh mục" name="add_danh_muc">
                                <span style="color: red;font-style: italic;"><?php echo @$error["name"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Danh mục parent</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="id_parent">
                                    <option value="0"> -- Không có --</option>
                                    <?php foreach (@$danhmuc as $key => $value) : ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Size</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="size" placeholder="Nhập size theo danh mục. Áo: M,L,XL,XXL, Quần: 28->34, Giày: 38->43">
                                <span style="color: red;font-style: italic;"><?php echo @$error['size']; ?></span>
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