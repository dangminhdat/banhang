<?php 
    require __DIR__."/../../core/init.php";
    $open = "admin";
    $title = "Quản lý admin - XP Shop";
    $admin = $db->fetch_all("admin");
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['level'] != 1)
    {
        echo "<script> alert('Bạn không phải là admin');</script>";
        echo "<script> location.href = '".base_url()."admin';</script>";
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
                        Quản lý admin
                        <a href="add" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-user"></i> admin
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admin as $key => $value): ?>
                                    <tr>
                                        <td><strong><?php echo $value['id']; ?></strong></td>
                                        <td><strong><?php echo $value['name']; ?></strong></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['phone']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><span class="label <?php echo ($value['level'] == 1)?'label-primary':'label-success'; ?>"><?php echo ($value['level'] == 1)?'ADMIN':'MEMBER'; ?></span></td>
                                        <td class="status_<?php echo $value['id']; ?>"><button data-id="<?php echo $value['id']; ?>" class="btn btn-xs <?php echo ($value['status'] == 1)?'btn-primary':'btn-danger' ?>"><?php echo ($value['status'] == 1)?'Hoạt động':'Khóa' ?></button></td>
                                        <td>
                                            <a href="edit/<?php echo $value['id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Sửa</a>
                                            <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- <ul class="pagination pull-right">
                            <li><a href=""><span>&laquo;</span></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><span>&raquo;</span></a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <script>
            $('td button').on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : 'admin.php',
                    type : "POST",
                    data : {
                        id : $id,
                        action : "status_admin"
                    },
                    success : function(data){
                        $('.status_'+$id+' button').toggleClass("btn-primary btn-danger");
                        $('.status_'+$id+' button').html(data);
                    }
                })   
            })
        </script>

<?php require_once __DIR__."/../../includes/footer.php"; ?>