<?php if($id_cate1 == "gioi-thieu") { ?>
	<div class="col-xs-12">
		<div class="gioithieuwebsite">
			<h1>Giới thiệu</h1>
			<p>Đây là website bán hàng online chuyên về áo quần phụ kiện của nam giới.</p>
			<p>Rất mong mọi người ủng hộ!</p>
		</div>
	</div>
<?php }else if($id_cate1 == "lien-he") { ?>
	<div class="col-xs-12">
		<div class="gioithieuwebsite">
			<h1>Liên hệ</h1>
			<p>1. Facebook: <a href="http://facebook.com/dangminhdat.77">Đạt Đặng</a></p>
			<p>2. Gmail: dangminhdat.qnam@gmail.com</p>
		</div>
	</div>
<?php }else {?>	
<div class="col-xs-12 error-404">
	<div class="error-div">
		<h1>404</h1>
		<p>Xin lỗi, trang bạn tìm không có!!!</p>
	</div>
</div>
<?php } ?>