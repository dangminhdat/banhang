<?php
	require __DIR__.'/../core/init.php';
	$action = postInput('action');
	if($action == "add-card")
	{
		$id = postInput('id');
		$soluong = (postInput("soluong"))?postInput("soluong"):1;
		$size = postInput("size");
		$sanpham = $db->fetch_id("sanpham",$id);
		if($sanpham['soluong'] < 1){
			echo "<h3 style='padding: 30px 30px'>Sản phẩm đã hết hàng</h3>";
		}
		else{
			if(!empty($_SESSION['add-card'][$sanpham['id']]))
			{
				$_SESSION['add-card'][$sanpham['id']]['soluong'] += $soluong;
			}
			else
			{
				$_SESSION['add-card'][$sanpham['id']]['name'] = $sanpham['name'];
				$_SESSION['add-card'][$sanpham['id']]['slug'] = $sanpham['slug'];
				$_SESSION['add-card'][$sanpham['id']]['price'] = $sanpham['price'];
				$_SESSION['add-card'][$sanpham['id']]['sale'] = $sanpham['sale'];
				$_SESSION['add-card'][$sanpham['id']]['thumbnail'] = $sanpham['thumbnail'];
				$_SESSION['add-card'][$sanpham['id']]['damua'] = $sanpham['head'];
				$_SESSION['add-card'][$sanpham['id']]['soluong'] = $soluong;
				$_SESSION['add-card'][$sanpham['id']]['parent_id'] = $sanpham['parent_id'];
				if($size)
					$_SESSION['add-card'][$sanpham['id']]['size'] = $size;
				else
					$_SESSION['add-card'][$sanpham['id']]['size'] = ($sanpham['parent_id'] == 1)?"M":(($sanpham['parent_id'] == 2)?"28":"");
			}
			$sl2 = 0;
			$tt = 0;
			foreach (@$_SESSION['add-card'] as $key => $value) {
				$sl2 += $value['soluong'];
				$tt += $value['soluong']*$value['price']*(100-$value['sale'])/100;
			}
			$_SESSION['add-card-sum'] = $tt;
			echo "<script>$('#bag-card').html('".$sl2."');</script>";
			echo "<h3 style='padding: 30px 30px'>Sản phẩm đã được thêm thành công</h3>";
		}
	}
	else if($action == "soluong-card")
	{
		$id = postInput("id");
		$val = postInput("val");
		$_SESSION['add-card'][$id]['soluong'] = $val;
		echo number_format($val*$_SESSION['add-card'][$id]['price']*(100-$_SESSION['add-card'][$id]['sale'])/100)."đ";
	}
	else if($action == "tongtien-card")
	{
		$id = postInput("id");
		$val = postInput("val");
		$tt = 0;
		foreach ($_SESSION['add-card'] as $key => $value) {
			if($key == $id)
				$tt += $val*$value['price']*(100-$value['sale'])/100;
			else
				$tt += $value['soluong']*$value['price']*(100-$value['sale'])/100;
		}
		$_SESSION['add-card-sum'] = $tt;
		echo number_format($tt)."đ";
	}
	else if($action == "delete-card")
	{
		$id = postInput("id");
		unset($_SESSION['add-card'][$id]);
	}
	else if($action == "user-card")
	{
		if(!empty($_SESSION['add-card']))
		{
			$province = postInput("province_card");
			$district = postInput("district_card");
			$commune = postInput("commune_card");
			$number = postInput("number_card");
			$address = $number.", ".$commune.", ".$district.", ".$province;
			$data = array(
				"name" 	=> postInput("name_card"),
				"email" => postInput("email_card"),
				"phone" => postInput("phone_card"),
				"address" => $address,
				"note" => postInput("note_card"),
				"pay" => postInput("pay_card"),
				"created_at" => $date
			);
			$id_insert = $db->insert("taikhoan",$data);
			if($id_insert)
			{
				$data_giaodich = array(
					"tongtien" => $_SESSION['add-card-sum'],
					"taikhoan_id" => $id_insert,
					"status" => "0",
				);
				$id_insert_giaodich = $db->insert("giaodich",$data_giaodich);
				if($id_insert_giaodich)
				{
					foreach ($_SESSION['add-card'] as $key => $value) :
						$data_dathang = array(
							"giaodich_id" => $id_insert_giaodich,
							"sanpham_id" => $key,
							"soluong" => $value['soluong'],
							"size" => $value['size'],
							"price"	=> $value['price'],
							"sale" => $value['sale']
						);
					$db->insert("dathang",$data_dathang);
					$number = $db->updateview("UPDATE sanpham SET head = head + 1 WHERE id = $key");
					endforeach;
				}
			}
			echo "Cảm ơn bạn đã đặt hàng. Nhân viên sẽ liên hệ với bạn sớm nhất.";
			session_destroy();
		}
		else
		{
			echo "Giỏ hàng bạn đang trống";
		}
	}
	else if($action == "timkiem")
	{
		$val = postInput("val");
		$sanpham = $db->fetch_sql("SELECT * FROM sanpham WHERE name LIKE '%$val%'");
?>
	<div class="container">
		<div class="col-xs-12">
			<div class="sanphamhot">
				<div class="col-md-12 text-center">
					<div class="tieude">
						<h3>TÌM KIẾM</h3>
					</div>
				</div>
				<div class="col-md-12 sanpham">
					<?php foreach ($sanpham as $key => $value) : ?>
						<?php 
							$danhmuc_parent = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $value[parent_id]");
							$danhmuc_child = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $value[chuyenmuc_con]");
						?>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="media text-center">
								<a href="">
									<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$value['slug'].'-'.$value['id'].'.html'; ?>">
										<span class="label <?php echo ($value['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($value['soluong']>0)?"Số lượng: ".$value['soluong']:"Hết hàng"; ?></span>
										<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
									</a>
									<strong><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$value['slug'].'-'.$value['id'].'.html'; ?>" class="tensanpham"><?php echo $value['name']; ?></a></strong>
									<p>Giá: <strong class="giasanpham" style="text-decoration: line-through;"><?php echo ($value['sale'] != 0)?number_format($value['price']):""; ?></strong> <strong class="giasanpham"><?php echo number_format(sale($value['price'],$value['sale'])); ?> VNĐ</strong></p>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php
	}
	else if($action == "show_size")
	{
		$id = postInput("id");
		$val = postInput("val");
		$_SESSION['add-card'][$id]['size'] = $val;
	}
?>