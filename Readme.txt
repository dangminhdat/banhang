folder:
	public:	file css,js,images,upload cả backend và frontend
		+ admin: chứa file file bên admin
		+ frontend: giao diện
	admin: xử lý các file,modules của admin(backend)
		+ modules:	các file quản lý như quản lý thành viên, sản phẩm
	core: xử lý các file chung mà tất cả file đều gọi
		+ chứa file init.php
	includes: chứa file từng phần giao diện
	libraries: tạo các file database, function, session
	partials: file hiển thị báo lỗi
database:
	+chuyenmuc: 
	CREATE TABLE `codethuan_banhang`.`chuyenmuc` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(100) NOT NULL , 
	`slug` VARCHAR(100) NOT NULL , 
	`hinh_anh` VARCHAR(100) NOT NULL , 
	`banner` VARCHAR(100) NOT NULL , 
	`home` TINYINT NOT NULL DEFAULT '0' , //hiển thị ra trang chủ
	`status` TINYINT NOT NULL DEFAULT '1' , //hiển thị trên menu
	`create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() , 
	`update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() , 
	PRIMARY KEY (`id`)
	) ENGINE = InnoDB;

	+taikhoan
	CREATE TABLE `codethuan_banhang`.`taikhoan` ( 
	`id` INT NOT NULL , `name` VARCHAR(100) NULL , 
	`email` VARCHAR(100) NULL , 
	`phone` CHAR(15) NULL , 
	`address` VARCHAR(100) NULL , 
	`password` VARCHAR(100) NULL , 
	`status` TINYINT NULL DEFAULT '1' ,
	`avatar` VARCHAR(100) NULL , 
	`token` VARCHAR(50) NULL , 
	`created_at` TIMESTAMP NULL , 
	`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP() NULL 
	) ENGINE = InnoDB;
	
	+admin
	CREATE TABLE `codethuan_banhang`.`admin` ( 
	`id` INT NOT NULL , 
	`name` VARCHAR(100) NULL , 
	`email` VARCHAR(100) NULL , 
	`phone` CHAR(15) NULL , 
	`address` VARCHAR(100) NULL , 
	`password` VARCHAR(100) NULL , 
	`status` TINYINT NULL DEFAULT '1' , 
	`level` TINYINT NULL DEFAULT '1' , 
	`avatar` VARCHAR(100) NULL , 
	`created_at` TIMESTAMP NULL , 
	`update_at` TIMESTAMP on update CURRENT_TIMESTAMP() NULL 
	) ENGINE = InnoDB;

	+sanpham
	CREATE TABLE `codethuan_banhang`.`sanpham` ( 
	`id` INT NOT NULL , 
	`name` VARCHAR(100) NULL , 
	`slug` VARCHAR(100) NULL , 
	`price` INT NULL , 
	`sale` TINYINT NULL DEFAULT '0' , 
	`thumbnail` VARCHAR(100) NULL , 
	`chuyenmuc_id` INT NULL , 
	`content` TEXT NULL , 
	`number` INT NULL DEFAULt '0',
	`head` INT NULL DEFAULT '0' , 
	`view` INT NULL DEFAULT '0' , 
	`hot` TINYINT NULL DEFAULT '0' , 
	`create_at` TIMESTAMP NULL , 
	`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP() NULL 
	) ENGINE = InnoDB;

	CREATE TABLE `codethuan_banhang`.`dathang` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`giaodich_id` INT NULL , 
	`sanpham_id` INT NULL , 
	`qty` TINYINT(4) NULL , 
	`price` INT NULL , 
	`create_at` TIMESTAMP NULL , 
	`update_at` TIMESTAMP on update CURRENT_TIMESTAMP() NULL , 
	PRIMARY KEY (`id`)
	) ENGINE = InnoDB;
	CREATE TABLE `codethuan_banhang`.`giaodich` ( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`soluong` INT NULL , 
	`taikhoan_id` INT NULL , 
	`status` TINYINT(4) NOT NULL DEFAULT '0' , 
	`create_at` TIMESTAMP NULL , 
	`update_at` TIMESTAMP on update CURRENT_TIMESTAMP() NULL , PRIMARY KEY (`id`)
	) ENGINE = InnoDB;