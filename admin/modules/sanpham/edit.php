<?php 
    require_once __DIR__."/../../core/init.php";
    $open = "sanpham";
    $title = "Sửa sản phẩm - XP Shop";
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

    $editSanpham = $db->fetch_id("sanpham",$id);
    if($editSanpham == NULL)
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirect_admin("sanpham");
    }
    
    /* 
    * danh mục sản phẩm parent
    */ 
    $danh_muc = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = 0");

    /* 
    * danh mục sản phẩm con
    */ 
    $danh_muc_con = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = $editSanpham[parent_id]");


    if(empty($editSanpham))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirect_admin("sanpham");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = array(
            "name" => postInput("edit_san_pham"),
            "slug" => to_slug(postInput("edit_san_pham")),
            "parent_id" => postInput("dm_san_pham"),
            "chuyenmuc_con" => postInput("dm_san_pham_con"),
            "price" => postInput("gia_san_pham"),
            "sale" => postInput("sale_san_pham"),
            "soluong" => postInput("sl_san_pham"),
            "describ" => postInput("describe_san_pham"),
            "content" => postInput("content_san_pham")
            );
        $dieukhien = array(
            "id" => $id
            );
        $error = [];

        if(postInput("edit_san_pham") == "")
        {
            $error["name"] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }
        if(postInput("dm_san_pham") == "")
        {
            $error["dm_san_pham"] = "Mời bạn nhập danh mục sản phẩm";
        }
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
        if(count($_FILES['edit_thumbnail']['name']) > 3)
        {
            $error['thumbnail'] = "Số lượng hình ảnh <= 3";
        }
       
        // insert vào
        if(empty($error))
        {   
            if(isset($_FILES['edit_thumbnail']))
            {
                $file_img = ""; 
                foreach ($_FILES['edit_thumbnail']['name'] as $key => $value) {
                    $file_name = $_FILES['edit_thumbnail']['name'][$key];
                    $file_type = $_FILES['edit_thumbnail']['type'][$key];
                    $file_tmp = $_FILES['edit_thumbnail']['tmp_name'][$key];
                    $file_error = $_FILES['edit_thumbnail']['error'][$key];
                    $file_size = $_FILES['edit_thumbnail']['size'][$key];

                    $type = explode(".",$file_name);
                    $name = name_rand().".".$type[1];
                    $file_img .= ",".$name;
                    @move_uploaded_file($file_tmp,ROOT."sanpham/".$name);
                }
                $data['slide_thumbnail'] = trim($file_img,",");
            }
            $id_insert_last = $db->update("sanpham",$data,$dieukhien);
            if(@$id_insert_last > 0 || @$_FILES['edit_thumbnail']['error'] == 0)
            {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_admin('sanpham');
            }
            else
            {
                $_SESSION['error'] = "Dữ liệu không thay đổi";
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
                        Cập nhật sản phẩm
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
                            <i class="fa fa-edit"></i> Cập nhật
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
                                    <option value="">-- Mời bạn chọn danh mục parent --</option>
                                    <?php foreach ($danh_muc as $key => $value) : ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo ($editSanpham['parent_id'] == $value['id'])?'selected="selected"':''; ?> ><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color: red;font-style: italic;"><?php echo @$error["dm_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Danh mục con</label>
                            <div class="col-sm-8">
                                <select name="dm_san_pham_con" id="dm_san_pham_con" class="form-control">
                                    <option value="">-- Mời bạn chọn danh mục con--</option>
                                    <?php foreach ($danh_muc_con as $key => $value) : ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo ($editSanpham['chuyenmuc_con'] == $value['id'])?'selected="selected"':''; ?> ><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color: red;font-style: italic;"><?php echo @$error["dm_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tên sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Tên sản phẩm" name="edit_san_pham" value="<?php echo $editSanpham['name']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["name"]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giá sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="number" name="gia_san_pham" placeholder="9.000.000" class="form-control" value="<?php echo $editSanpham['price']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["gia_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" name="sl_san_pham" placeholder="0" class="form-control" value="<?php echo $editSanpham['soluong']; ?>">
                                <span style="color: red;font-style: italic;"><?php echo @$error["sl_san_pham"]; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Giảm giá</label>
                            <div class="col-sm-8">
                                <input type="number" name="sale_san_pham" placeholder="10" class="form-control" value="<?php echo $editSanpham['sale']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hình ảnh</label>
                            <div class="col-sm-3">
                                <input type="file" accept="image/*" class="form-control" name="edit_thumbnail[]" multiple>
                                <span style="color: red;font-style: italic;"><?php echo @$error['thumbnail']; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hình ảnh hiện tại</label>
                            <div class="col-sm-8">
                                <?php 
                                    $img = explode(',',$editSanpham['slide_thumbnail']);
                                    foreach ($img as $key => $value) :
                                ?>
                                <img src="<?php echo uploads()."sanpham/".$value; ?>" alt="" style="width: 80px; height: 80px">
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Miêu tả</label>
                            <div class="col-sm-8">
                                <textarea name="describe_san_pham" rows="10" class="form-control"><?php echo $editSanpham['describ']; ?></textarea>
                                <span style="color: red;font-style: italic;"><?php echo @$error['describe']; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea name="content_san_pham" rows="10" class="form-control"><?php echo $editSanpham['content']; ?></textarea>
                                <span style="color: red;font-style: italic;"><?php echo @$error['content']; ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
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