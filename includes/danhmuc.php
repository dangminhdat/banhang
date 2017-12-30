			<div class="col-md-9" style="margin-top: -35px">
				<?php foreach ($data_danhmucsub as $key => $value) : ?>
					<div class="sanphamhot">
						<div class="col-md-12 text-center">
							<div class="tieude">
								<h3><a href="<?php echo'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.to_slug($key); ?>"><?php echo $key; ?></a></h3>
							</div>
						</div>

						<div class="col-md-12 sanpham">
							<?php foreach ($data_danhmucsub[$key] as $keyC => $valueC) : ?>
							<div class="col-sm-6 col-md-4 col-xs-12">
								<div class="media text-center">
									<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.to_slug($key).'/'.$valueC['slug'].'-'.$valueC['id'].'.html'; ?>">
										<span class="label <?php echo ($valueC['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($valueC['soluong']>0)?"Số lượng: ".$valueC['soluong']:"Hết hàng"; ?></span>
										<img src="<?php echo uploads(); ?>sanpham/<?php echo $valueC['thumbnail']; ?>" alt="">
									</a>	
									<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.to_slug($key).'/'.$valueC['slug'].'-'.$valueC['id'].'.html'; ?>"><strong class=""><?php echo $valueC['name']; ?></strong></a>
									<p>Giá: <strong style="text-decoration: line-through;"><?php echo ($valueC['sale'] != 0)?number_format($valueC['price']):""; ?></strong> <strong><?php echo number_format(sale($valueC['price'],$valueC['sale'])); ?> VNĐ</strong> <strong></strong></p>
									<button class="btn btn-xs btn-xs btn-info add-card" data-id="<?php echo $valueC['id'] ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>