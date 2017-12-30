<?php 
	require __DIR__."/../../core/init.php";
	$open = "setting";
    $title = "Cài đặt chung - XP Shop";
	if(empty($_SESSION['id']) || empty($_SESSION['id']) || empty($_SESSION['name']))
    {
        header('Location: '.base_url().'admin/login.php');
    }
    else if(@$_SESSION['status'] == 0)
    {
        echo "<script> alert('Tài khoản của bạn đã bị khóa');</script>";
        echo "<script> location.href = '".base_url()."admin/logout.php';</script>";
    }
    $website = $db->fetch_one("SELECT * FROM website");
?>
<?php require __DIR__."/../../includes/header.php"; ?>
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Cài đặt chung
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li>
                            <i class="fa fa-cog"></i> Cài đặt chung
                        </li>
                    </ol>

                    <!-- Thông báo lỗi -->
                    <?php require __DIR__."/../../../partials/notifications.php"; ?>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading">
                    		<h3 class="panel-title">Trạng thái hoạt động</h3>
                    	</div>
                    	<div class="panel-body">
                    		<button class="show_status btn <?php echo ($website['status'] == 0)?"btn-danger":"btn-success" ?>"><?php echo ($website['status'] == 0)?"Đóng":"Mở"; ?></button>
                    	</div>
                    </div>
                </div>
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-heading">
                			<h3 class="panel-title">Thông tin website</h3>
                		</div>
                		<div class="panel-body">
                			<div class="form-group">
                				<label>Tiêu đề website</label>
                				<input type="text" class="form-control title-website" value="<?php echo $website['title']; ?>">
                			</div>
                			<div class="form-group">
                				<label>Từ khóa</label>
                				<input type="text" class="form-control keyword-website" value="<?php echo $website['keywords']; ?>">
                			</div>
                			<div class="form-group">
                				<label>Mô tả website</label>
                				<input type="text" class="form-control describ-website" value="<?php echo $website['describ']; ?>">
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
        <script>
        	$(".show_status").on("click",function(){
        		$.ajax({
        			url : 'setting.php',
        			type : "POST",
        			data : {
        				action : "show_status"
        			},
        			success : function(data){
        				$(".show_status").toggleClass("btn-danger btn-success");
        				$(".show_status").html(data);
        			},
        			error : function(){
        				alert("Đã có lỗi xảy ra, vui lòng thử lại sau!");
        			}
        		})
        	})
        	$(".title-website").on("keyup",function(){
        		$title = $(".title-website").val();
        		$.ajax({
        			url : 'setting.php',
        			type : "POST",
        			data : {
        				title : $title,
        				action : "edit_title"
        			},
        			success : function(){},
        			error : function(){
        				alert("Đã có lỗi xảy ra, vui lòng thử lại sau!");
        			}
        		})
        	})
        	$(".keyword-website").on("keyup",function(){
        		$keyword = $(".keyword-website").val();
        		$.ajax({
        			url : 'setting.php',
        			type : "POST",
        			data : {
        				keyword : $keyword,
        				action : "edit_keyword"
        			},
        			success : function(){},
        			error : function(){
        				alert("Đã có lỗi xảy ra, vui lòng thử lại sau!");
        			}
        		})
        	})
        	$(".describ-website").on("keyup",function(){
        		$describ = $(".describ-website").val();
        		$.ajax({
        			url : 'setting.php',
        			type : "POST",
        			data : {
        				describ : $describ,
        				action : "edit_describ"
        			},
        			success : function(){},
        			error : function(){
        				alert("Đã có lỗi xảy ra, vui lòng thử lại sau!");
        			}
        		})
        	})
        </script>
<?php require __DIR__."/../../includes/footer.php"; ?>