<?php 
    require __DIR__."/../../core/init.php";
    $open = "chuyenmuc";
    $title = "Danh mục sản phẩm - XP Shop";
    $danhmuc = $db->fetch_all("chuyenmuc");
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
?>

<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Danh sách danh mục
                        <a href="add" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-file"></i> Danh mục
                        </li>
                    </ol>

                    <!-- Thông báo lỗi -->
                    <?php require __DIR__."/../../../partials/notifications.php"; ?>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Danh mục parent</th>
                                    <th>Hiển thị</th>
                                    <th>Size</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($danhmuc as $key => $value): ?>
                                <?php $danhmucnext = $db->fetch_one("SELECT name FROM chuyenmuc WHERE id = $value[id_parent]"); ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $danhmucnext['name']; ?></td>
                                        <td><button data-id="<?php echo $value['id']; ?>" data-home="<?php echo $value['home']; ?>" class="home_danhmuc btn btn-xs <?php echo ($value['home'] == 1)?"btn-primary":"btn-danger"; ?>"><?php echo ($value['home'] == 1)?"Hiển thị":"Khóa"; ?></button></td>
                                        <?php /*<!-- <td><button data-id="<?php echo $value['id']; ?>" data-status="<?php echo $value['status']; ?>" class="status_danhmuc btn btn-xs <?php echo ($value['status'] == 1)?"btn-primary":"btn-danger"; ?>"><?php echo ($value['status'] == 1)?"Hoạt động":"Khóa"; ?></button></td> --> */?>
                                        <td><strong><?php echo $value['size']; ?></strong></td>
                                        <td>
                                            <a href="edit/<?php echo $value['id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Sửa</a>
                                            <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <script>
                                $(".status_danhmuc").on("click",function(){
                                    $status = $(this).attr("data-status");
                                    $id = $(this).attr("data-id");
                                    $.ajax({
                                        url : "chuyenmuc.php",
                                        type : "POST",
                                        data : {
                                            status : $status,
                                            id : $id
                                        },
                                        success : function(data){
                                            location.reload();
                                        }
                                    })
                                });
                                $(".home_danhmuc").on("click",function(){
                                    $home = $(this).attr("data-home");
                                    $id = $(this).attr("data-id");
                                    $.ajax({
                                        url : "chuyenmuc.php",
                                        type : "POST",
                                        data : {
                                            home : $home,
                                            id : $id
                                        },
                                        success : function(data){
                                            location.reload();
                                        }
                                    })
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

<?php require_once __DIR__."/../../includes/footer.php"; ?>