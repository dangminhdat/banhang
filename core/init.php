<?php
	// error_reporting(0);
	session_start();
	require __DIR__.'/../libraries/database.php';
	require __DIR__.'/../libraries/function.php';
	$db = new database();

	define("ROOT",$_SERVER['DOCUMENT_ROOT'].'/public/uploads/');

	$website = $db->fetch_one("SELECT * FROM website");
	if($website['status'] == 0 && (@$_SESSION['status'] == 0 || @$_SESSION['level'] == 2))
	{
		echo "<title>Bảo trì</title>";
		echo "<h1 align='center'>Website đang trong thời gian bảo trì và nâng cấp!</h1>";
		exit();
	}

	/*
	*	time
	*/ 
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$date = date("Y/m/d H:i:s",time());

	/*
	*	lấy danh mục
	*/ 
	$danhmuc = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = 0 AND home = 1");

	/*
	*	lấy sản phẩm hot
	*/ 
	$sanphamhot = $db->fetch_sql("SELECT * FROM sanpham WHERE hot = 1 ORDER BY id DESC LIMIT 8");

	/*
	*	lấy danh sách sản phẩm home
	*/
	$data_sanpham = [];
	foreach ($danhmuc as $key => $value) {
		$sql = "SELECT * FROM sanpham WHERE parent_id = $value[id] ORDER BY id DESC LIMIT 8";
		$sanpham = $db->fetch_sql($sql);
		$data_sanpham[$value['name']] = $sanpham;
	}

	/*
	*	lấy danh mục sub
	*/
	$id_cate1 = getInput("id_cate1");
	$id_cate2 = getInput("id_cate2");
	$id_post = (getInput("id_post")<=$db->total_data("SELECT * FROM sanpham"))?getInput("id_post"):false;
	$danhmucsub = $db->fetch_sql("SELECT * FROM chuyenmuc WHERE id_parent = (SELECT id FROM chuyenmuc WHERE slug = '$id_cate1') AND home = 1");
	$data_danhmucsub = [];
	foreach (@$danhmucsub as $key => $value) {
		$data_danhmucsub[$value['name']] = $db->fetch_sql("SELECT * FROM sanpham WHERE chuyenmuc_con = $value[id] ORDER BY id DESC LIMIT 6");
	}
	/*
	*	breadcrums
	*/ 
	$breadcrumb = $db->fetch_one("SELECT * FROM chuyenmuc WHERE slug = '$id_cate1'");
	$breadcrumb_con = $db->fetch_one("SELECT * FROM chuyenmuc WHERE slug = '$id_cate2'");

	/*
	*	lấy sản phẩm danh mục sub
	*/ 
	$page_sub = (getInput('page'))?getInput('page'):1;
	$data_sanphamsub = $db->fetch_pagi("SELECT * FROM sanpham WHERE chuyenmuc_con = (SELECT id FROM chuyenmuc WHERE slug = '$id_cate2')",$page_sub,6,$count = $db->total_data("SELECT * FROM sanpham WHERE chuyenmuc_con = (SELECT id FROM chuyenmuc WHERE slug = '$id_cate2')"),true);
	if(isset($data_sanphamsub['page']))
	{
		$number_page = $data_sanphamsub['page'];
		unset($data_sanphamsub['page']);
	}
	

	/*
	*	chi tiết sản phẩm
	*/ 
	if(@$id_post){
		$view = $db->updateview("UPDATE sanpham SET view = view + 1 WHERE id = $id_post");
		$chitiet_sanpham = $db->fetch_id("sanpham",$id_post);
		$dm = $db->fetch_id("chuyenmuc",$chitiet_sanpham['parent_id']);
		$size = ($dm['size'] != "")?explode(',',$dm['size']):"";
		/*
		*	sản phẩm cùng chuyên mục
		*/
		$data_relate = [];
		$sanpham_relate = ($id_post)?$db->fetch_sql("SELECT * FROM sanpham WHERE chuyenmuc_con = $chitiet_sanpham[chuyenmuc_con] AND id != $id_post"):false;
		$rand_array = @array_rand($sanpham_relate,(count($sanpham_relate)<4?count($sanpham_relate):4));
		if($rand_array)
			foreach ($rand_array as $key => $value) {
				$data_relate[] = $sanpham_relate[$value];
			}

	}

	/*
	*	sản phẩm mua nhiều
	*/
	$sanpham_muanhieu = $db->fetch_sql("SELECT * FROM sanpham ORDER BY head DESC LIMIT 4");

	/*
	*	số lượng giỏ hàng
	*/
	$tongtien = 0;
	$tongsanpham = count(@$_SESSION['add-card']);
	$sl = 0;
	if(isset($_SESSION['add-card']))
		foreach (@$_SESSION['add-card'] as $key => $value) {
			$sl += $value['soluong'];
		}

	// _debug($_SESSION);
	// echo "<pre>";
	// print_r($sanpham_muanhieu);
	// echo "</pre>";
?>