    <?php 
    require __DIR__."/../../core/init.php";
    $open = "quanlydonhang";
    $title = "Quản lý đơn hàng - XP Shop";
    if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    $page = getInput("page")?getInput("page"):1;
    $limit = 10;
    $start = ($page - 1) * $limit;
    $quanlydonhang = $db->fetch_sql("SELECT tk.id,tk.name,tk.email,tk.phone,tk.address,tk.note,GROUP_CONCAT(dh.sanpham_id) AS chitiet, GROUP_CONCAT(dh.soluong) AS soluongchitiet, GROUP_CONCAT(dh.size) as size, GROUP_CONCAT(dh.price) AS price, GROUP_CONCAT(dh.sale) AS sale,gd.tongtien,gd.status,tk.pay,tk.created_at as ngay FROM `taikhoan` tk INNER JOIN giaodich gd ON gd.taikhoan_id = tk.id INNER JOIN dathang dh ON dh.giaodich_id = gd.id GROUP by tk.id ORDER BY tk.id DESC LIMIT $start,$limit");
    $total_page = ceil(count($db->fetch_all("taikhoan"))/$limit);

?>

<?php require_once __DIR__."/../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Quản lý đơn hàng
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-file"></i> Đơn hàng
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
                                    <th>Tên khách hàng</th>
                                    <th>Thông tin khách hàng</th>
                                    <th>Thông tin sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (@$quanlydonhang as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><strong><?php echo $value['name']; ?></strong></td>
                                        <td style="width: 20%">
                                           <p><strong>Email:</strong><?php echo $value['email']; ?></p>
                                           <p><strong>Phone:</strong><?php echo $value['phone']; ?></p>
                                           <p><strong>Address:</strong><?php echo $value['address']; ?></p>
                                        </td>
                                        <td>
                                            <?php 
                                                $thongtin = explode(",",$value['chitiet']);
                                                $soluongchitiet = explode(",",$value['soluongchitiet']);
                                                $size = explode(",",$value['size']);
                                                foreach ($thongtin as $keyC => $valueC) {
                                                   $sanpham = $db->fetch_id("sanpham",$valueC);

                                            ?>
                                                <p><strong><?php echo ($keyC+1).".".$sanpham['name']; ?></strong></p>
                                                <p>Size: <?php echo $size[$keyC]; ?></p>
                                                <p>Số lượng:<?php echo $soluongchitiet[$keyC]; ?></p>
                                                <p>Giá:<?php echo number_format($sanpham['price']); ?>VNĐ</p>
                                                <p>Sales:<?php echo $sanpham['sale']; ?>%</p>
                                            <?php
                                                }
                                            ?>
                                            <p><strong>Tổng tiền:<?php echo number_format($value['tongtien']); ?>VNĐ</strong></p>
                                        </td>
                                        <td>
                                            <button class="btn <?php echo ($value['status'] == 0)?"btn-danger":"btn-success"; ?> btn-sm xacnhan-<?php echo $value['id'] ?>" data-id="<?php echo $value['id']; ?>"><?php echo ($value['status'] == 0?"Chưa giao":"Đã giao"); ?></button>
                                        </td>
                                        <td>
                                            <?php switch (@$value['pay']) {
                                                case '0':
                                                    echo "<span class='label label-primary'>Thanh toán văn phòng</span>";
                                                    break;
                                                case '1':
                                                    echo "<span class='label label-primary'>Chuyển khoản ngân hàng</span>";
                                                    break;
                                                case '2':
                                                    echo "<span class='label label-primary'>Thanh toán giao hàng</span>";
                                                    break;
                                            } ?>
                                        </td>
                                        <td>
                                            <p><?php echo substr($value['ngay'],11); ?></p>
                                            <p><?php echo substr($value['ngay'],0,10); ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul class="pagination pull-right">
                            <?php if($page > 1) : ?>
                                <li><a href="?page=<?php echo ($page-1); ?>">&laquo;</a></li>
                            <?php endif; ?>
                            <?php for ($i=1; $i <= $total_page; $i++) { 
                                if($i == $page)
                                {
                            ?>
                                <li class="active"><a><?php echo $i; ?></a></li>
                            <?php
                                }
                                else
                                {
                            ?>
                                <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                            } ?>
                            <?php if($page < $total_page) : ?>
                                <li><a href="?page=<?php echo ($page+1); ?>">&raquo;</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <script>
            $('button').on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : 'quanlydonhang.php',
                    type : "POST",
                    data : {
                        id : $id,
                        action : "apply_status"
                    },
                    success : function(data){
                        $(".xacnhan-"+$id).toggleClass("btn-danger btn-success").html(data);
                    }
                })
            })
        </script>

<?php require_once __DIR__."/../../includes/footer.php"; ?>