if($('div').hasClass('image_big')){
		var slides = 1;
		slideshow(slides);
		function current(param){
			slideshow(slides = param);
		}
		function slideshow(k){
			var img = document.getElementsByClassName('big_image');
			var small_img = document.getElementsByClassName('small_image');
			for (var i = 0; i < img.length; i++) {
				img[i].style.display = "none";
			}
			for (var i = 0; i < small_img.length; i++) {
				small_img[i].className = "small_image";
			}
			small_img[k-1].className += " active";
			img[k-1].style.display = "block";
		}
	}
$(document).ready(function(){
  	$(".slide-anh .owl-carousel").owlCarousel({
  		items:1,
	    loop:true,
	    margin:10,
	    autoplay:true,
	    autoplayTimeout:1500,
	    autoplayHoverPause:true
  	});
  	$(".slide-anh-2 .owl-carousel").owlCarousel({
  		margin:10,
	    autoplay:true,
	    autoplayTimeout:5000,
	    autoplayHoverPause:true,
	    responsive: {
	    	0: {
	    		items: 1,
	    		nav: true
	    	},
	    	600: {
	    		items: 2,
	    		nav: false
	    	},
	    	900: {
	    		items: 3,
	    		nav: false
	    	}
	    }
  	});

	$('.add-card').on("click",function(){
		$id = $(this).attr("data-id");
		$.ajax({
			url : 'includes/xuly.php',
			type : "POST",
			data : {
				id : $id,
				action : "add-card"
			},
			success : function(data){
				$('#add-card-success').html(data);
			},
			error : function(){
				$('#add-card-success').html("Thêm sản phẩm thất bại. Vui lòng thêm lại.");
			}
		})
	})
	$('.add-card-soluong').on("click",function(){
		$id = $(this).attr("data-id");
		$soluong = $('#soluongsanpham').val();
		$size = $('#size_sanpham').val();
		$.ajax({
			url : 'includes/xuly.php',
			type : "POST",
			data : {
				id : $id,
				soluong : $soluong,
				size : $size,
				action : "add-card"
			},
			success : function(data){
				$('#add-card-success').html(data);
			},
			error : function(){
				$('#add-card-success').html("Thêm sản phẩm thất bại. Vui lòng thêm lại.");
			}
		})
	})
	$('.soluong-sanpham').on("keyup change",function(){
		$id = $(this).attr('data-id');
		$val = $(this).val();
		$.ajax({
			url : 'includes/xuly.php',
			type : 'POST',
			data : {
				id : $id,
				val : $val,
				action : "soluong-card"
			},
			success : function(data){
				$(".sanpham-"+$id).html(data);

				$.ajax({
					url : 'includes/xuly.php',
					type : 'POST',
					data : {
						id : $id,
						val : $val,
						action : "tongtien-card"
					},
					success : function(data){
						$('.tongtien-card').html(data)
					}
				})
			}
		})
	});
	$('.delete-card').on("click",function(){
		$id = $(this).attr("data-id");
		$.ajax({
			url : 'includes/xuly.php',
			type : 'POST',
			data : {
				id : $id,
				action : "delete-card"
			},
			success : function(){
				location.reload();
			}
		})
	})
	$('#lienhegiohang button').on("click",function(){
		$this = $('#lienhegiohang button');
		$this.html("ĐANG GỞI...");
		$error = 0;

		$data = {
			'name_card' : $('#lienhegiohang input[name="name-card"]').val(),
			'email_card' : $('#lienhegiohang input[name="email-card"]').val(),
			'phone_card' : $('#lienhegiohang input[name="phone-card"]').val(),
			'province_card' : $('#lienhegiohang select[name="province-card"]').val(),
			'district_card' : $('#lienhegiohang input[name="district-card"]').val(),
			'commune_card' : $('#lienhegiohang input[name="commune-card"]').val(),
			'number_card' : $('#lienhegiohang input[name="number-card"]').val(),
			'note_card' : $('#lienhegiohang input[name="note-card"]').val(),
			'pay_card' : $('#lienhegiohang select[name="pay-card"]').val()
		};
		if($data.name_card == "")
		{
			$('#lienhegiohang input[name="name-card"]').next().html("Vui lòng điền đầy đủ họ tên");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="name-card"]').next().html("");
		}
		if($data.email_card == "")
		{
			$('#lienhegiohang input[name="email-card"]').next().html("Vui lòng điền đầy đủ email");
			$error++;
		}
		else if(!(/^[a-z][a-z0-9_\.\-]{2,32}\@([a-z0-9]+\.[a-z]+){1,2}$/i.test($data.email_card)))
		{
			$('#lienhegiohang input[name="email-card"]').next().html("Email không đúng định dạng cho phép");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="email-card"]').next().html("");
		}
		if($data.phone_card == "")
		{
			$('#lienhegiohang input[name="phone-card"]').next().html("Vui lòng điền số điện thoại");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="phone-card"]').next().html("");
		}
		if($data.province_card == -1)
		{
			$('#lienhegiohang input[name="province-card"]').next().html("Vui lòng điền tỉnh thành");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="province-card"]').next().html("");
		}
		if($data.district_card == "")
		{
			$('#lienhegiohang input[name="district-card"]').next().html("Vui lòng điền quận huyện");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="district-card"]').next().html("");
		}
		if($data.commune_card == "")
		{
			$('#lienhegiohang input[name="commune-card"]').next().html("Vui lòng điền xã phường");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="commune-card"]').next().html("");
		}
		if($data.number_card == "")
		{
			$('#lienhegiohang input[name="number-card"]').next().html("Vui lòng điền số nhà");
			$error++;
		}
		else
		{
			$('#lienhegiohang input[name="number-card"]').next().html("");
		}

		if($error == 0)
		{
			$.ajax({
				url : "includes/xuly.php",
				type : "POST",
				data : {
					name_card : $data.name_card,
					email_card : $data.email_card,
					phone_card : $data.phone_card,
					province_card : $data.province_card,
					district_card : $data.district_card,
					commune_card : $data.commune_card,
					number_card : $data.number_card,
					note_card : $data.note_card,
					pay_card : $data.pay_card,
					action : "user-card"
				},
				success : function(data){
					$('#lienhegiohang .thongbao').addClass("alert alert-success");
					$('#lienhegiohang .thongbao').html(data);
					$this.html("GỞI ĐƠN HÀNG");
					// location.reload();
				},
				error : function(){
					alert("Lỗi xảy ra.");
					location.reload();
				}
			})
		}
		else
		{
			$this.html("GỞI ĐƠN HÀNG");
			$error = 0;
		}
	})
	$("#btn_timkiem").on("click",function(){
		$val = $("#func_timkiem").val();
		$.ajax({
			url : 'includes/xuly.php',
			type : 'POST',
			data : {
				val : $val,
				action : "timkiem"
			},
			success : function(data){
				$("#hienthi_timkiem").html(data);
			},
			error : function(){
				alert("Đã có lỗi xảy ra, Vui lòng thử lại sau!");
			}
		})
	})
	$('.size-add-card').on("change",function(){
		$val = $(this).val();
		$id = $(this).attr("data-id");
		$.ajax({
			url : "includes/xuly.php",
			type : "POST",
			data : {
				id : $id,
				val : $val,
				action : "show_size"
			},
			success : function(){},
			error : function(){
				alert("Đã có xảy ra lỗi, vui lòng thử lại sau!");
			}
		})
	})
});
	