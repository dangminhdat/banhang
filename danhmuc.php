<?php require __DIR__.'/core/init.php'; ?>
<?php require __DIR__.'/includes/header.php'; ?>
			<div class="col-xs-12">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="./">Trang chủ</a></li>
					<li class="active"><span><?php echo $breadcrumb['name']; ?></span></li>
				</ol>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default danhmuc">
					<div class="panel-heading">
						<p class="panel-title">DANH MỤC</p>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<?php foreach ($danhmucsub as $key => $value) : ?>
								<li class="list-group-item"><a href="danhmuc-sub.php?id=<?php echo $value['id_parent']; ?>&id_con=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
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
				<div class="qc">
					<img src="public/frontend/image/qc.png" alt="">
				</div>
			</div>

			<div class="col-md-9" style="margin-top: -35px">
				<?php foreach ($data_danhmucsub as $key => $value) : ?>
					<div class="sanphamhot">
						<div class="col-md-12 text-center">
							<div class="tieude">
								<h3><?php echo $key; ?></h3>
							</div>
						</div>

						<div class="col-md-12 sanpham">
							<?php foreach ($data_danhmucsub[$key] as $keyC => $valueC) : ?>
							<div class="col-sm-4 col-xs-12">
								<div class="media text-center">
									<img src="<?php echo uploads(); ?>sanpham/<?php echo $valueC['thumbnail']; ?>" alt="">
									<strong class=""><?php echo $valueC['name']; ?></strong>
									<p>Giá: <strong style="text-decoration: line-through;"><?php echo ($valueC['sale'] != 0)?number_format($valueC['price']):""; ?></strong> <strong><?php echo number_format(sale($valueC['price'],$valueC['sale'])); ?> VNĐ</strong> <strong></strong></p>
									<button class="btn btn-xs btn-xs btn-info add-card" data-id="<?php echo $valueC['id'] ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php require __DIR__.'/includes/footer.php'; ?>