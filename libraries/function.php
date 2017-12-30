<?php 

    /*
    *   hình thức thanh toán
    */ 
    function pay_card(){
        return ["Thanh toán tại văn phòng","Chuyển khoản ngân hàng","Thanh toán khi giao hàng"];
    }

    /*
    *   tỉnh thành
    */
    function district_card(){
        $string = "An Giang,Bà Rịa - Vũng Tàu,Bắc Giang,Bắc Kạn,Bạc Liêu,Bắc Ninh,Bến Tre,Bình Định,Bình Dương,Bình Phước,Bình Thuận,Cà Mau,Cao Bằng,Đắk Lắk,Đắk Nông,Điện Biên,Đồng Nai,Đồng Tháp,Gia Lai,Hà Giang,Hà Nam,Hà Tĩnh,Hải Dương,Hậu Giang,Hòa Bình,Hưng Yên,Khánh Hòa,Kiên Giang,Kon Tum,Lai Châu,Lâm Đồng,Lạng Sơn,Lào Cai,Long An,Nam Định,Nghệ An,Ninh Bình,Ninh Thuận,Phú Thọ,Quảng Bình,Quảng Nam,Quảng Ngãi,Quảng Ninh,Quảng Trị,Sóc Trăng,Sơn La,Tây Ninh,Thái Bình,Thái Nguyên,Thanh Hóa,Thừa Thiên Huế,Tiền Giang,Trà Vinh,Tuyên Quang,Vĩnh Long,Vĩnh Phúc,Yên Bái,Phú Yên,Cần Thơ,Đà Nẵng,Hải Phòng,Hà Nội,TP HCM";
        $array = explode(",",$string);
        sort($array);
        return $array;
    } 

	/**
    * tao slug
    **/
	function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
    /*
    *   rand_char
    */
    function name_rand()
    {
        $AZ = range('A','Z');
        $az = range('a','z');
        $so = range('0','9');
        $string = substr(str_shuffle(implode('',array_merge($AZ,$az,$so))),0,5);
        return $string;
    }

	/**
    * url base
    **/
	function base_url()
	{
		return 'http://banhang.byethost5.com/';
	}

	/**
    * url admin public
    **/
    function public_admin()
    {
    	return base_url().'public/admin/';
    }

    /**
    * url frontend public
    **/
    function public_frontend()
    {
    	return base_url().'public/frontend/';
    }

    /**
    * modules
    **/
    function modules($url)
    {
    	return base_url().'admin/modules/'.$url;
    }

    /*
    * uploads
    */ 
    function uploads()
    {
        return base_url()."public/uploads/";
    }

    /**
    * redirect
    **/
    if(!function_exists('redirect_admin'))
    {
    	function redirect_admin($url = '')
    	{
    		header("Location: ".base_url().'admin/modules/'.$url);
    		exit();
    	}
    }

	/**
    * debug
    **/
	function _debug($data){
		echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';

        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);

        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';

        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
	}

    /*
    * get INPUT
    */
    function getInput($string)
    {
        return isset($_GET[$string])?$_GET[$string]:'';
    }

	/*
	* post INPUT
	*/
	function postInput($string)
	{
		return isset($_POST[$string])?$_POST[$string]:'';
	}

    /*
    * sale
    */ 
    function sale($price,$sale)
    {
        $price = intval($price);
        $sale = intval($sale);

        $result = $price*((100 - $sale)/100);    
        return $result;
    }
    function email($string)
    {
        $result = preg_match("/[a-z][a-z0-9_\.]{2,}@[a-z0-9]{2,}([\.[a-z0-9]){1,2}/imsU",$string);
        return $result;
    }
?>