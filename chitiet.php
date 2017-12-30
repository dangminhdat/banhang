<?php require __DIR__.'/core/init.php'; ?>
<?php require __DIR__.'/includes/header.php'; ?>
			<div class="col-xs-12">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="./">Trang chủ</a></li>
					<li class="active"><span><?php echo $chitiet_sanpham['name']; ?></span></li>
				</ol>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default khoangia">
					<div class="panel-heading">
						<p class="panel-title">Khoảng giá</p>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item"><a href=""> Dưới 300,000đ</a></li>
							<li class="list-group-item"><a href=""> 300,000 ~ 1,000,000đ</a></li>
							<li class="list-group-item"><a href=""> 1,000,000 ~ 2,000,000đ</a></li>
							<li class="list-group-item"><a href=""> 2,000,000 ~ 3,000,000đ</a></li>
							<li class="list-group-item"><a href=""> 3,000,000 ~ 5,000,000đ</a></li>
							<li class="list-group-item"><a href=""> Trên 5,000,000đ</a></li>
						</ul>
					</div>
				</div>
				<div class="panel panel-default khoangia">
					<div class="panel-heading">
						<p class="panel-title">Mua nhiều</p>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item">
								<img src="public/frontend/image/anh1.jpg" width="100" height="100" alt="" class="pull-left">
								<div>
									<strong>Đầm chấm bi</strong>
									<p>Giá: <strong>2,500,000đ</strong></p>
								</div>
							</li>
							<li class="list-group-item">
								<img src="public/frontend/image/anh1.jpg" width="100" height="100" alt="" class="pull-left">
								<div>
									<strong>Đầm chấm bi</strong>
									<p>Giá: <strong>2,500,000đ</strong></p>
								</div>
							</li>
							<li class="list-group-item">
								<img src="public/frontend/image/anh1.jpg" width="100" height="100" alt="" class="pull-left">
								<div>
									<strong>Đầm chấm bi</strong>
									<p>Giá: <strong>2,500,000đ</strong></p>
								</div>
							</li>
							<li class="list-group-item">
								<img src="public/frontend/image/anh1.jpg" width="100" height="100" alt="" class="pull-left">
								<div>
									<strong>Đầm chấm bi</strong>
									<p>Giá: <strong>2,500,000đ</strong></p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- <div class="qc">
					<img src="public/frontend/image/qc.png" alt="">
				</div> -->
			</div>

			<div class="col-md-9" style="margin-top: -35px">
				
					<div class="sanphamhot">
						<div class="col-md-12 text-center">
							<div class="tieude">
								<h3 style="left: -27%"><?php echo $chitiet_sanpham['name']; ?></h3>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="media">
								<div class="media-left">
									<div class="image_big media-object">
										<?php
											$i=1;
											$img_slide = explode(",",$chitiet_sanpham['slide_thumbnail']);
											foreach ($img_slide as $key => $value) :
										?>
											<img class="big_image" src="<?php echo uploads(); ?>sanpham/<?php echo $value; ?>" alt="">
										<?php endforeach; ?>
										<div id="image_small">
										<?php foreach ($img_slide as $key => $value) : ?>
											<img src="<?php echo uploads(); ?>sanpham/<?php echo $value; ?>" class="small_image" alt="" onclick="current(<?php echo $i; ?>)">
										<?php 
											$i++;
											endforeach;
										?>
										</div>
									</div>
								</div>
								<div class="media-body">
									<h2><strong><?php echo $chitiet_sanpham['name']; ?></strong></h2>
									<h1><?php echo number_format($chitiet_sanpham['price']*(100-$chitiet_sanpham['sale'])/100); ?></h1>
									<p><strong>Miêu tả: </strong><?php echo @$chitiet_sanpham['describ']; ?></p>
									<div class="muahang">
										<?php if(!empty($size)) : ?>
										<p><span>Kích thước: </span><select name="" id="">
												<?php foreach ($size as $key => $value) : ?>
													<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
												<?php endforeach; ?>
											</select>
										</p>
										<?php endif; ?>
										<p><span>Số lượng: </span><input type="number" value="1"></p>
										<p>
											<button class="btn btn-lg btn-warning"><i class="fa fa-shopping-cart fa-fw"></i> Mua ngay</button>
											<button class="btn btn-lg btn-default"><i class="fa fa-plus fa-fw"></i>Thêm vào giỏ hàng</button>
										</p>
									</div>
							</div>
							<div class="motasanpham">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#mota" data-toggle="tab">Mô tả sản phẩm</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="mota">
										<?php echo @$chitiet_sanpham['content']; ?>
									</div>
								</div>
							</div>
							<div class="sanphamlienquan">
								<h3>Sản phẩm cùng chuyên mục</h3>
								<div class="slide-anh-2">
									<div class="owl-carousel">
									  	<?php foreach ($data_relate as $key => $value) : ?>
									  	<div class="lienquan text-center">
									  		<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
											<p><a href="<?php echo base_url(); ?>chitiet.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></p>
											<p>Giá: <span><?php echo number_format($value['price']); ?></span></p>
											<button class="btn btn-xs btn-primary">Thêm vào giỏ hàng</button>
									  	</div>
									  	<?php endforeach; ?>
									</div>
								</div>	
							</div>
						</div>
					</div>
				
			</div>
		</div>
	</div>

<?php require __DIR__.'/includes/footer.php'; ?>