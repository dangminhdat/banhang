
<?php require __DIR__.'/core/init.php'; ?>
<?php require __DIR__.'/includes/header.php'; ?>
			<div class="col-xs-12">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="./">Trang chủ</a></li>
					<li><a href="danhmuc.php?id=<?php echo $breadcrumb['id']; ?>"><?php echo $breadcrumb['name']; ?></a></li>
					<li class="active"><span><?php echo $breadcrumb_con['name']; ?></span></li>
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
								<li class="list-group-item"><a href="danhmuc-sub.php?id=<?php echo $value['id_parent']; ?>&id_con=<?php echo $value['id'] ?>"><?php echo $value['name']; ?></a></li>
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

			<div class="col-md-9">
				<div class="sanphamhot danhmucsanpham">
					<div class="col-md-12 text-center">
						<div class="tieude">
							<h3><?php echo $breadcrumb_con['name']; ?></h3>
						</div>
					</div>

					<div class="col-md-12 sanpham bg-warning">
						<?php foreach ($data_sanphamsub as $key => $value) : ?>
						<div class="col-md-4 col-xs-6">
							<div class="media text-center">
								<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
								<strong class=""><?php echo $value['name']; ?></strong>
								<p>Giá: <strong style="text-decoration: line-through;"><?php echo ($value['sale'] != 0)?number_format($value['price']):""; ?></strong> <strong><?php echo number_format(sale($value['price'],$value['sale'])); ?> VNĐ</strong> <strong></strong></p>
								<button class="btn btn-info btn-xs">Thêm vào giỏ hàng</button>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<ul class="pagination pull-right">
						<?php if($page_sub > 1) : ?>
						<li><a href="<?php echo str_replace("page=$page_sub","page=".($page_sub-1),$_SERVER['REQUEST_URI']); ?>"><span>&laquo;</span></a></li>
						<?php endif; ?>
						<?php for ($i=1; $i <= $number_page; $i++) : ?>
						<?php if($i == $page_sub) {?>
							<li class="active"><a><?php echo $i; ?></a></li>
						<?php }else{ ?>
							<li><a href="<?php echo empty($_GET['page'])?$_SERVER['REQUEST_URI']."&page=".$i:str_replace("page=$page_sub","page=".$i,$_SERVER['REQUEST_URI']); ?>"><?php echo $i; ?></a></li>
						<?php } ?>
						<?php endfor; ?>	
						<?php if($page_sub < $number_page) : ?>
						<li><a href="<?php echo empty($_GET['page'])?$_SERVER['REQUEST_URI']."&page=".($page_sub+1):str_replace("page=$page_sub","page=".($page_sub+1),$_SERVER['REQUEST_URI']); ?>"><span>&raquo;</span></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php require __DIR__.'/includes/footer.php'; ?>