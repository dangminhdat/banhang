				<div class="col-md-9" style="margin-top: -35px">
				
					<div class="sanphamhot">
						<div class="col-md-12 text-center">
							<div class="tieude">
								<h3 style="left: -2%"><?php echo $chitiet_sanpham['name']; ?></h3>
							</div>
						</div>

						<div class="col-md-12">
							<div class="media">
								<div class="media-left">
									<div class="image_big media-object">
										<?php
											$img_slide = explode(",",$chitiet_sanpham['slide_thumbnail']);
											foreach ($img_slide as $key => $value) :
										?>
											<img class="big_image" src="<?php echo uploads(); ?>sanpham/<?php echo $value; ?>" alt="">
										<?php endforeach; ?>
										<div id="image_small">
										<?php foreach ($img_slide as $key => $value) : ?>
											<img src="<?php echo uploads(); ?>sanpham/<?php echo $value; ?>" class="small_image" alt="" onclick="current(<?php echo ($key+1); ?>)">
										<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="media-body">
									<h2><strong><?php echo $chitiet_sanpham['name']; ?></strong> <i class="fa fa-eye"> <?php echo $chitiet_sanpham['view']; ?></i></h2>
									<h1><?php echo number_format($chitiet_sanpham['price']*(100-$chitiet_sanpham['sale'])/100); ?> <span class="thongtinsoluong label <?php echo ($chitiet_sanpham['soluong']>0)?"label-success":"label-danger"; ?>"><?php echo ($chitiet_sanpham['soluong']>0)?"Số lượng: ".$chitiet_sanpham['soluong']:"Hết hàng"; ?></span></h1>
									<p><strong>Miêu tả: </strong><?php echo @$chitiet_sanpham['describ']; ?></p>
									<div class="muahang">
										<?php if(!empty($size)) : ?>
										<p><span>Kích thước: </span><select name="" id="size_sanpham">
												<?php foreach ($size as $key => $value) : ?>
													<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
												<?php endforeach; ?>
											</select>
										</p>
										<?php endif; ?>
										<p><span>Số lượng: </span><input id="soluongsanpham" type="number" value="1"></p>
										<p>
											<a href="<?php echo base_url(); ?>add-card.html" class="btn btn-lg btn-warning"><i class="fa fa-shopping-cart fa-fw"></i> Giỏ hàng</a>
											<button class="btn btn-lg btn-default add-card-soluong" data-id="<?php echo $chitiet_sanpham['id']; ?>" data-toggle="modal" data-target="#show-add"><i class="fa fa-plus fa-fw"></i>Thêm vào giỏ hàng</button>
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
									  		<a href="<?php echo base_url().to_slug($breadcrumb['name']).'/'.to_slug($breadcrumb_con['name']).'/'.$value['slug'].'-'.$value['id'].'.html'; ?>">
									  			<img src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" alt="">
									  		</a>
											<p><a href="<?php echo base_url().to_slug($breadcrumb['name']).'/'.to_slug($breadcrumb_con['name']).'/'.$value['slug'].'-'.$value['id'].'.html'; ?>"><?php echo $value['name']; ?></a></p>
											<p>Giá: <span><?php echo number_format($value['price']); ?></span></p>
											<button class="btn btn-xs btn-primary add-card" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#show-add">Thêm vào giỏ hàng</button>
									  	</div>
									  	<?php endforeach; ?>
									</div>
								</div>	
							</div>
						</div>
					</div>
				
				</div>
			</div>