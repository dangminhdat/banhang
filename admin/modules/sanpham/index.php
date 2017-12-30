<?php 
    require __DIR__."/../../core/init.php";
    $open = "sanpham";
    $title = "Tất cả sản phẩm - XP Shop";
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    $page = (getInput('page'))?getInput('page'):1;

    $sql = "SELECT * FROM sanpham";
    $sanpham = $db->fetch_pagi($sql,$page,10,$db->countTable("sanpham"),true);
    $danhmuc = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = 0");

    if(isset($sanpham['page']))
    {
        $sotrang = $sanpham['page'];
        unset($sanpham['page']);
    }
?>

<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Danh sách sản phẩm
                        <a href="add" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-database"></i> Sản phẩm
                        </li>
                    </ol>

                    <!-- Thông báo lỗi -->
                    <?php require __DIR__."/../../../partials/notifications.php"; ?>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row select-danhmuc">
                <div class="col-xs-12">
                    <label class="col-xs-offset-1 col-xs-3">Chọn danh mục parent</label>
                    <div class="col-xs-6">
                        <select class="form-control col-xs-5" id="danhmuc">
                            <option value=""> -- Chọn danh mục -- </option>
                            <?php foreach ($danhmuc as $key => $value) : ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>       
                </div>
                <div class="col-xs-12">
                    <label class="col-xs-offset-1 col-xs-3">Chọn danh mục parent</label>
                    <div class="col-xs-6">
                        <select class="form-control" id="danhmuccon">
                            <option value="">Trống</option>
                        </select>
                    </div>
                    <button class="btn-sm btn btn-success">Xem</button>       
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive" id="sanphamhienthi">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Sản phẩm hot</th>
                                    <th>Thumbnail</th>
                                    <th>Thông tin</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sanpham as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><strong><?php echo $value['name']; ?></strong></td>
                                        <td><strong><?php
                                                $danhmuc_parent = $db->fetch_one("SELECT name FROM chuyenmuc WHERE id = $value[parent_id]"); 
                                                $danhmuc_con = $db->fetch_one("SELECT name FROM chuyenmuc WHERE id = $value[chuyenmuc_con]");
                                                echo $danhmuc_parent['name'];
                                                echo (@$danhmuc_con['name'])?", ".$danhmuc_con['name']:""; 
                                            ?></strong></td>
                                        <td class="status_button_<?php echo $value['id']; ?>"><button data-id="<?php echo $value['id']; ?>" class="btn btn-xs <?php echo ($value['hot']==1)?"btn-primary":"btn-danger"; ?>"><?php echo ($value['hot']==1)?"Có":"Không"; ?></button></td>
                                        <td>
                                            <?php if($value['thumbnail'] == '') : ?>
                                                <span class="future" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#image_future">Chọn hình ảnh</span>
                                            <?php else : ?>
                                                <img class="future" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#image_future" src="<?php echo uploads().'sanpham/'.$value['thumbnail']; ?>" alt="" style="width: 90px; height: 90px;">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <p>Giá: <?=number_format($value['price'])?></p>
                                            <p>Số lượng: <?=$value['soluong']?></p>
                                            <p>Sales: <?php echo $value['sale']; ?>%</p>
                                        </td>
                                        <td>
                                            <a href="edit/<?php echo $value['id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Sửa</a>
                                            <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul class="pagination pull-right">
                            <?php if($sotrang > 1 && $page > 1): ?>
                                <li><a href="?page=<?php echo ($page-1); ?>"><span>&laquo;</span></a></li>
                            <?php endif; ?>
                                <?php for ($i=1; $i <= $sotrang; $i++) : ?>
                                    <?php if($i == $page) { ?> 
                                        <li class="active"><a><?=$i?></a></li>
                                    <?php }else{ ?>
                                        <li><a href="?page=<?php echo $i; ?>"><?=$i?></a></li>
                                    <?php } ?>
                                <?php endfor; ?>
                            <?php if($sotrang > 1 && $page < $sotrang): ?>
                                <li><a href="?page=<?php echo ($page+1); ?>"><span>&raquo;</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <script>
            $("td button").on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : 'sanpham.php',
                    type : "POST",
                    data : {
                        id : $id,
                        action : 'status_sanpham'
                    },
                    success : function(data){
                        $(".status_button_"+$id+" button").toggleClass("btn-danger btn-primary");
                        $(".status_button_"+$id+" button").html(data);
                    }
                })
            })
            $("#danhmuc").on("change",function(){
                $id = $(this).val();
                $.ajax({
                    url : 'sanpham.php',
                    type : "POST",
                    data : {
                        id_parent : $id,
                        action : "show_parent"
                    },
                    success : function(data){
                        $('#danhmuccon').html(data);

                        $('.select-danhmuc button').on("click",function(){
                            $id_con = $("#danhmuccon").val();
                            $.ajax({
                                url : 'sanpham.php',
                                type : "POST",
                                data : {
                                    id_con : $id_con,
                                    action : "hienthi"
                                },
                                success : function(data){
                                    $("#sanphamhienthi").html(data);
                                }
                            })
                        })
                    }
                })
            })
            $('.future').on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : 'sanpham.php',
                    type : 'POST',
                    data : {
                        id : $id,
                        action : "show_future"
                    },
                    success : function(data){
                        $('.modal-body.text-center').html(data);
                    }
                })
            })
        </script>

<?php require_once __DIR__."/../../includes/footer.php"; ?>