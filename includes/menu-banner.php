			<div class="col-md-3">
				<div class="panel panel-default danhmuc">
					<div class="panel-heading">
						<p class="panel-title">DANH MỤC</p>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<?php foreach ($danhmuc as $key => $value) : ?>
								<li class="list-group-item"><a href="<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-9">
				<div class="col-md-12 slide-anh">
					<div class="owl-carousel">
					  	<div><img src="<?php echo base_url(); ?>public/frontend/image/slide1.jpg" alt=""></div>
						<div><img src="<?php echo base_url(); ?>public/frontend/image/slide2.jpg" alt=""></div>
						<div><img src="<?php echo base_url(); ?>public/frontend/image/slide3.jpg" alt=""></div>
						<div><img src="<?php echo base_url(); ?>public/frontend/image/slide4.jpg" alt=""></div>
					</div>
				</div>	
			</div>