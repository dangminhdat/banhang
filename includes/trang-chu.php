			<div class="col-xs-12">	
				<div class="sanphamhot">
					<div class="col-md-12 text-center">
						<div class="tieude">
							<h3>SẢN PHẨM HOT</h3>
						</div>
					</div>

					<div class="col-md-12 sanpham">
						<?php foreach ($sanphamhot as $key => $value) : ?>
							<?php 
								$danhmuc_parent = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $value[parent_id]");
								$danhmuc_child = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $value[chuyenmuc_con]");
							?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="media text-center">
									<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$value['slug'].'-'.$value['id'].'.html'; ?>">
										<span class="label <?php echo ($value['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($value['soluong']>0)?"Số lượng: ".$value['soluong']:"Hết hàng"; ?></span>
										<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
									</a>
									<strong><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$value['slug'].'-'.$value['id'].'.html'; ?>" class="tensanpham"><?php echo $value['name']; ?></a></strong>
									<p>Giá: <strong class="giasanpham" style="text-decoration: line-through;"><?php echo ($value['sale'] != 0)?number_format($value['price']):""; ?></strong> <strong class="giasanpham"><?php echo number_format(sale($value['price'],$value['sale'])); ?> VNĐ</strong></p>
									<button class="btn btn-xs btn-xs btn-info add-card" data-id="<?php echo $value['id'] ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>	
				<?php foreach ($data_sanpham as $key => $value) : ?>
				<div class="sanphamhot">
					<div class="col-md-12 text-center">
						<div class="tieude">
							<h3>
								<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($key); ?>"><?php echo ucwords($key); ?></a>
							</h3>
						</div>
					</div>

					<div class="col-md-12 sanpham">
						<?php foreach ($data_sanpham[$key] as $keyC => $valueC) : ?>
							<?php 
								$danhmuc_parent = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $valueC[parent_id]");
								$danhmuc_child = $db->fetch_one("SELECT slug FROM chuyenmuc WHERE id = $valueC[chuyenmuc_con]");
							?>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="media text-center">
									<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$valueC['slug'].'-'.$valueC['id'].'.html'; ?>">
										<span class="label <?php echo ($valueC['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($valueC['soluong']>0)?"Số lượng: ".$valueC['soluong']:"Hết hàng"; ?></span>
										<img src="<?php echo uploads(); ?>sanpham/<?php echo $valueC['thumbnail']; ?>" alt="">
									</a>
									<strong><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']."/".$danhmuc_parent['slug']."/".$danhmuc_child['slug']."/".$valueC['slug'].'-'.$valueC['id'].'.html'; ?>" class="tensanpham"><?php echo $valueC['name']; ?></a></strong>
									<p>Giá: <strong class="giasanpham" style="text-decoration: line-through;"><?php echo ($valueC['sale'] != 0)?number_format($valueC['price']):""; ?></strong> <strong class="giasanpham"><?php echo number_format(sale($valueC['price'],$valueC['sale'])); ?> VNĐ</strong></p>
									<button class="btn btn-info btn-xs add-card" data-id="<?php echo $valueC['id'] ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>