<?php 
	require __DIR__.'/../../core/init.php';

	$action = postInput("action");
	if($action == "show_parent")
	{
		$id_parent = postInput("id_parent");
		$danh_muc_con = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = $id_parent");
		foreach ($danh_muc_con as $key => $value) {
			echo "<option value=".$value['id'].">".$value['name']."</option>";
		}
	}
	else if($action == "status_sanpham")
	{
		$id = postInput("id");
		$sanpham = $db->fetch_one("SELECT * FROM sanpham WHERE id = $id");
		$hot = ($sanpham['hot'] == 1)?0:1;
		$update = $db->update("sanpham",array("hot"=>$hot),array("id"=>$id));
?>
		<?php echo ($hot==1)?"Có":"Không"; ?>
<?php
	}
    else if($action == "set_future")
    {
        $id = postInput("id");
        $thumbnail = postInput("thumbnail");
        $count = $db->updateview("UPDATE sanpham SET thumbnail = '$thumbnail' WHERE id = $id");
        if($count > 0)
        {
            $_SESSION['success'] = "Thêm ảnh đại diện thành công";
        }
        else
        {
            $_SESSION['error'] = "Thêm thất bại";
        }
    }
    else if($action == "show_future")
    {
        $id = postInput("id");
        $sanpham = $db->fetch_id("sanpham",$id);
        $slide = explode(",",$sanpham['slide_thumbnail']);
        foreach ($slide as $key => $value) :
?>
        <img data-text="<?php echo $value; ?>" data-id="<?php echo $id; ?>" src="<?php echo uploads(); ?>sanpham/<?php echo $value; ?>" alt="">
<?php
        endforeach;
?>
    <script>
        $('.modal-body.text-center img').on("click",function(){
            $(this).css("border","1px solid #ccc"); 
            $id = $(this).attr("data-id");
            $thumbnail = $(this).attr("data-text");
            $.ajax({
                url : $base + 'home.php',
                type : "POST",
                data : {
                    id : $id,
                    thumbnail : $thumbnail,
                    action : "set_future"
                },
                success : function(data){
                    alert("ĐANG XỬ LÝ...");
                    location.reload();
                }
            })
        })
    </script>
<?php
    }
	else if($action == "hienthi")
	{
		$id_con = postInput("id_con");
		$sanpham = $db->fetch_sql("SELECT * FROM sanpham WHERE chuyenmuc_con = $id_con ORDER BY id DESC");
?>
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
                <td><strong>
                	<?php
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
                        <img class="future" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#image_future" src="<?php echo uploads().'sanpham/'.$value['thumbnail']; ?>" alt="" style="width: 80px; height: 80px;">
                    <?php endif; ?>
                </td>
                <td>
                    <p>Giá: <?=number_format($value['price'])?></p>
                    <p>Số lượng: <?=$value['soluong']?></p>
                    <p> Sales: <?=$value['sale']?>%</p>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="delete.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        <script>
        	$base = 'http://banhang.byethost5.com/admin/modules/sanpham/';
        	$("td button").on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : $base + 'home.php',
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
            $('.future').on("click",function(){
                $id = $(this).attr("data-id");
                $.ajax({
                    url : $base + 'home.php',
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
<?php
	}
?>