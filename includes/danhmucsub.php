			<div class="col-md-9">
				<div class="sanphamhot danhmucsanpham">
					<div class="col-md-12 text-center">
						<div class="tieude">
							<h3><?php echo $breadcrumb_con['name']; ?></h3>
						</div>
					</div>

					<div class="col-md-12 sanpham">
						<?php foreach ($data_sanphamsub as $key => $value) : ?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="media text-center">
								<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.to_slug($breadcrumb_con['name']).'/'.$value['slug'].'-'.$value['id'].'.html'; ?>">
									<span class="label <?php echo ($value['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($value['soluong']>0)?"Số lượng: ".$value['soluong']:"Hết hàng"; ?></span>
									<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
								</a>
								<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.to_slug($breadcrumb['name']).'/'.to_slug($breadcrumb_con['name']).'/'.$value['slug'].'-'.$value['id'].'.html'; ?>">
									<strong class=""><?php echo $value['name']; ?></strong>
								</a>
								<p>Giá: <strong style="text-decoration: line-through;"><?php echo ($value['sale'] != 0)?number_format($value['price']):""; ?></strong> <strong><?php echo number_format(sale($value['price'],$value['sale'])); ?> VNĐ</strong> <strong></strong></p>
								<button class="btn btn-info btn-xs add-card" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<ul class="pagination pull-right">
						<?php if($page_sub > 1) : ?>
						<li><a href="<?php echo str_replace("page/$page_sub","page/".($page_sub-1),$_SERVER['REQUEST_URI']); ?>"><span>&laquo;</span></a></li>
						<?php endif; ?>
						<?php for ($i=1; $i <= $number_page; $i++) : ?>
						<?php if($i == $page_sub) {?>
							<li class="active"><a><?php echo $i; ?></a></li>
						<?php }else{ ?>
							<li><a href="<?php echo empty($_GET['page'])?$_SERVER['REQUEST_URI']."/page/".$i:str_replace("page/$page_sub","page/".$i,$_SERVER['REQUEST_URI']); ?>"><?php echo $i; ?></a></li>
						<?php } ?>
						<?php endfor; ?>	
						<?php if($page_sub < $number_page) : ?>
						<li><a href="<?php echo empty($_GET['page'])?$_SERVER['REQUEST_URI']."/page/".($page_sub+1):str_replace("page/$page_sub","page/".($page_sub+1),$_SERVER['REQUEST_URI']); ?>"><span>&raquo;</span></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>