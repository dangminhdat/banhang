<?php 
    require_once __DIR__."/../../core/init.php";
    $open = "sanpham";
    $title = "Thêm sản phẩm - XP Shop";
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    /* 
    * danh mục sản phẩm parent
    */ 
    $danh_muc = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = 0");

    /* 
    * danh mục sản phẩm con
    */ 
    $danh_muc_con = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent != 0");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = array(
            "name" => postInput("add_san_pham"),
            "slug" => to_slug(postInput("add_san_pham")),
            "parent_id" => postInput("dm_san_pham"),
            "chuyenmuc_con" => postInput("dm_san_pham_con"),
            "price" => postInput("gia_san_pham"),
            "sale" => postInput("sale_san_pham"),
            "soluong" => postInput("sl_san_pham"),
            "describ" => postInput("describe_san_pham"),
            "content" => postInput("content_san_pham")
            );
        $error = [];

        if(postInput("add_san_pham") == "")
        {
            $error["name"] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }
        if(postInput("dm_san_pham") == "")
        {
            $error["dm_san_pham"] = "Mời bạn nhập danh mục sản phẩm parent";
        }
        // if(postInput("dm_san_pham_con") == "")
        // {
        //     $error["dm_san_pham_con"] = "Mời bạn nhập danh mục sản phẩm con";
        // }
        if(postInput("gia_san_pham") == "")
        {
            $error["gia_san_pham"] = "Mời bạn nhập giá sản phẩm";
        }  
        if(postInput("sl_san_pham") == "")
        {
            $error["sl_san_pham"] = "Mời bạn nhập số lượng sản phẩm";
        }       
        if(postInput("content_san_pham") == "")
        {
            $error['content'] = "Mời bạn nhập nội dung sản phẩm";
        }
        if(postInput("describe_san_pham") == "")
        {
            $error['describe'] = "Mời bạn nhập miêu tả sản phẩm";
        }
        if(@$_FILES['thumbnail']['error'][0] > 0)
        {
            $error['thumbnail'] = "Mời bạn chọn hình ảnh";
        }
        if(count(@$_FILES['thumbnail']['name']) > 3)
        {
            $error['thumbnail'] = "Số lượng hình ảnh <= 3";
        }
        

        // insert vào
        if(empty($error))
        {
            if(isset($_FILES['thumbnail']))
            {
                $file_img = ""; 
                foreach ($_FILES['thumbnail']['name'] as $key => $value) {
                    $file_name = $_FILES['thumbnail']['name'][$key];
                    $file_type = $_FILES['thumbnail']['type'][$key];
                    $file_tmp = $_FILES['thumbnail']['tmp_name'][$key];
                    $file_error = $_FILES['thumbnail']['error'][$key];
                    $file_size = $_FILES['thumbnail']['size'][$key];

                    $type = explode(".",$file_name);
                    $name = name_rand().".".$type[1];
                    $file_img .= ",".$name;
                    @move_uploaded_file($file_tmp,ROOT."sanpham/".$name);
                }
                $data['slide_thumbnail'] = trim($file_img,",");
            }
            $id_insert_last = $db->insert("sanpham",$data);
            if(@$id_insert_last)
            {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_admin('sanpham');
            }
            else
            {
                $_SESSION['error'] = "Thêm mới thất bại";
                redirect_admin('sanpham');
            }
        }
    }

?>
<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Thêm mới sản phẩm
                        <a href="./" class="btn btn-success"><span class="fa fa-arrow-left"></span> Trở về</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-database"></i> Sản phẩm
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
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Danh mục parent</label>
                            <div class="col-sm-8">
                                <select name="dm_san_pham" id="dm_san_pham" class="form-control">
                                    <option value="">-- Mời bạn chọn danh mục sản phẩm parent --</option>
                                    <?php foreach ($danh_muc as $key => $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color: red;font-style: italic;"><?php echo @$error["dm_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Danh mục con</label>
                            <div class="col-sm-8">
                                <select name="dm_san_pham_con" id="dm_san_pham_con" class="form-control">
                                    <option value="">-- Mời bạn chọn danh mục sản phẩm con --</option>
                                    <?php foreach ($danh_muc_con as $key => $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tên sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Tên sản phẩm" name="add_san_pham" value="<?php echo @$data['name']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["name"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giá sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="number" name="gia_san_pham" placeholder="9.000.000" class="form-control" value="<?php echo @$data['price']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["gia_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" name="sl_san_pham" placeholder="0" class="form-control" value="<?php echo @$data['number']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["sl_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Giảm giá</label>
                            <div class="col-sm-3">
                                <input type="number" name="sale_san_pham" placeholder="10" class="form-control" value="<?php echo @$data['sale']; ?>">
                            </div>

                            <label class="col-sm-2 control-label">Hình ảnh</label>
                            <div class="col-sm-3">
                                <input type="file" accept="image/*" class="form-control" name="thumbnail[]" multiple>
                                <span style="color: red;font-style: italic;"><?php echo @$error['thumbnail']; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Miêu tả</label>
                            <div class="col-sm-8">
                                <textarea name="describe_san_pham" rows="5" class="form-control" placeholder="Miêu tả"><?php echo @$data['describ']; ?></textarea>
                                <span style="color: red;font-style: italic;"><?php echo @$error['describe']; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea name="content_san_pham" rows="10" class="form-control"><?php echo @$data['content']; ?></textarea>
                                <span style="color: red;font-style: italic;"><?php echo @$error['content']; ?></span>
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
        <script>
            $('#dm_san_pham').on("change",function(){
                $id_parent = $(this).val();
                $.ajax({
                    url : 'sanpham.php',
                    type : "POST",
                    data : {
                        id_parent : $id_parent,
                        action : "show_parent"
                    },
                    success : function(data){
                        $('#dm_san_pham_con').html(data);
                    }
                })
            })
        </script>


<?php require_once __DIR__."/../../includes/footer.php"; ?>
    <script>
        config = {};
        config.entities_latin = false;
        config.language = "vi";
        CKEDITOR.replace("content_san_pham", config);
    </script>