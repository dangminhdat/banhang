<?php 
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		if(getInput("id_cate1") && getInput("id_cate2") && getInput("id_content") && getInput("id_post"))
		{
			if($breadcrumb_con && $breadcrumb && $id_post)
			{
				require __DIR__.'/menu-danhmuc.php';
				require __DIR__.'/chitiet.php';
			}
			else
			{
				require __DIR__.'/error.php';
			}
		}
		else if(getInput("id_cate1") && getInput("id_cate2"))
		{
			if($breadcrumb_con && $breadcrumb)
			{
				require __DIR__.'/menu-danhmuc.php';
				require __DIR__.'/danhmucsub.php';
			}
			else
			{
				require __DIR__.'/error.php';
			}
		}
		else if(getInput("id_cate1"))
		{
			if($breadcrumb)
			{
				require __DIR__.'/menu-danhmuc.php';
				require __DIR__.'/danhmuc.php';
			}
			else
			{
				require __DIR__.'/error.php';
			}
		}
		else
		{
			require __DIR__.'/menu-banner.php';
			require __DIR__.'/trang-chu.php';
		}
	}
?>