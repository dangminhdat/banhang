			<div class="col-xs-12">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>">Trang chủ</a></li>
					<li class="active"><span><?php echo ($id_cate2)?$breadcrumb_con['name']:$breadcrumb['name']; ?></span></li>
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
								<li class="list-group-item"><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.$value['slug']; ?>"><?php echo $value['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<!-- <div class="panel panel-default khoangia">
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
				</div> -->
				<div class="panel panel-default khoangia">
					<div class="panel-heading">
						<p class="panel-title">Mua nhiều</p>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<?php foreach ($sanpham_muanhieu as $key => $value) : ?>
							<?php $parent = $db->fetch_id("chuyenmuc",$value['parent_id']) ?>
							<?php $child = $db->fetch_id("chuyenmuc",$value['chuyenmuc_con']) ?>
							<li class="list-group-item">
								<a href="<?php echo base_url().$parent['slug']."/".$child['slug']."/".$value['slug']."-".$value['id'].".html"; ?>">
									<img src="<?php echo uploads()."sanpham/".$value['thumbnail']; ?>" width="100" height="100" alt="" class="pull-left">
								</a>
								<div>
									<a href="<?php echo base_url().$parent['slug']."/".$child['slug']."/".$value['slug']."-".$value['id'].".html"; ?>">
										<strong><?php echo $value['name']; ?></strong>
									</a>
									<p>Giá: <strong><?php echo number_format($value['price']*(100-$value['sale'])/100); ?></strong></p>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="qc">
					<img src="public/frontend/image/qc.png" alt="">
				</div>
			</div>