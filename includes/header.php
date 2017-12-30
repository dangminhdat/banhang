<?php 
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		if(getInput("id_cate1") && getInput("id_cate2") && getInput("id_content") && getInput("id_post"))
		{
			if($breadcrumb_con && $breadcrumb && $id_post)
			{
				$title = $chitiet_sanpham['name'];
			}
			else
			{
				$title = "404";
			}
		}
		else if(getInput("id_cate1") && getInput("id_cate2"))
		{
			if($breadcrumb_con && $breadcrumb)
			{
				$title = $breadcrumb_con['name'];
			}
			else
			{
				$title = "404";
			}
		}
		else if(getInput("id_cate1"))
		{
			if($breadcrumb)
			{
				$title = $breadcrumb['name'];
			}
			else
			{
				if($id_cate1 == "gioi-thieu")
				{
					$title = "Giới thiệu";
				}
				else if($id_cate1 == "lien-he")
				{
					$title = "Liên hệ";
				}
				else
				{
					$title = "404";
				}
			}
		}
		else
		{
			$title = "Website bán hàng online";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?> | XP Shop</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/style/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/style/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/owlcarousel/assets/owl.theme.default.min.css">
</head>
<body>
	<!-- menutop -->
	<nav class="navbar navbar-default navbar-static-top menutop">
		<div class="container">
			<!-- <div class="row"> -->
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url()."gioi-thieu"; ?>">Giới thiệu</a></li>
					<li><a href="<?php echo base_url()."lien-he"; ?>">Liên hệ</a></li>
				</ul>
				<?php if(isset($_SESSION['name'])) : ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a>Xin chào <?=@$_SESSION['name']?></a></li>
						<li><a href="<?php echo base_url(); ?>admin">admin</a></li>
					</ul>
				<?php endif; ?>
			<!-- </div> -->
		</div>
	</nav>
	<!-- end menutop -->


	<!-- header -->
	<div class="header">
		<div class="container">
			<div class="col-sm-3 col-xs-12 logo">
				<a href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url(); ?>public/frontend/image/logo.png" alt="" width="150" height="130">
				</a>
			</div>
			<div class="col-sm-4 face">
				<form id="timkiem" action="" onsubmit="return false;">
					<div class="input-group">
						<input type="text" id="func_timkiem" class="form-control" placeholder="Nhập sản phẩm cần tìm...">
						<div class="input-group-btn">
							<button class="btn btn-default" id="btn_timkiem">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-4 col-xs-3 col-xs-offset-1 face">
				<p>Facebook:<span>Like</span><span>Share</span></p>
			</div>
		</div>
	</div>
	<!-- end header -->

	<nav class="navbar navbar-default navbar-static-top mainmenu">
		<div class="container">
			<div class="navbar-header">
				<button class="btn btn-default navbar-toggle" data-toggle="collapse" data-target="#mainmenu">☰</button>
				<a href="<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>" class="navbar-brand">Home</a>
			</div>
			<div class="collapse navbar-collapse" id="mainmenu">
				<ul class="nav navbar-nav">
					<?php foreach ($danhmuc as $key => $value) : ?>
						<li><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$value['slug']; ?>"><?php echo $value['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<a href="<?php echo base_url(); ?>add-card.html" class="giohang pull-right">
					<span>
						<span id="bag-card" class="badge"><?php echo $sl; ?></span>
					</span>
				</a>
			</div>
		</div>	
	</nav>
	
	<div class="sidebar" id="hienthi_timkiem">
		<div class="container">