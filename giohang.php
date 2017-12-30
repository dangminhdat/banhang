<?php require __DIR__.'/core/init.php'; ?>
<?php require __DIR__.'/includes/header.php'; ?>
			<div class="col-xs-12">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
					<li class="active"><span>Giỏ hàng</span></li>
				</ol>
			</div>
			<div class="col-md-12">
				<div class="sanphamhot danhmucsanpham">
					<div class="col-md-12 text-left">
						<div class="tieude giohang">
							<h3>DANH SÁCH SẢN PHẨM</h3>
						</div>
					</div>

					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Giá</th>
										<th>Số lượng</th>
										<th>Size</th>
										<th>Cộng</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($_SESSION['add-card'])) : ?>
									<?php foreach (@$_SESSION['add-card'] as $key => $value) : ?>
									<?php 
										$size_sanpham = $db->fetch_one("SELECT size FROM chuyenmuc WHERE id = $value[parent_id]");
									?>
										<tr>
											<td>
												<img class="pull-left" src="<?php echo uploads(); ?>sanpham/<?php echo $value['thumbnail']; ?>" width="120" height="120" alt="">
												<div class="table-next">
													<p><strong><?php echo $value['name']; ?></strong></p>
													<small>Có <?php echo $value['damua']; ?> người mua sản phẩm này</small>
													<p><button class="label label-danger delete-card" data-id="<?php echo $key; ?>">Xóa</button></p>
												</div>
											</td>
											<td>
												<strong><?php echo number_format($value['price']*(100-$value['sale'])/100); ?>đ</strong>
											</td>
											<td>
												<input type="number" min="1" data-id="<?php echo $key; ?>" class="soluong-sanpham" size="1" value="<?php echo $value['soluong']; ?>">
											</td>
											<td>
												<?php if(!empty($size_sanpham['size'])) : ?>
												<?php $size = explode(",",$size_sanpham['size']); ?>
												<p>
													<select data-id="<?php echo $key; ?>" class="size-add-card">
														<?php foreach ($size as $keyC => $valueC) : ?>
															<option <?php echo ($valueC == @$value['size'])?"selected='selected'":""; ?> value="<?php echo $valueC; ?>"><?php echo $valueC; ?></option>
														<?php endforeach; ?>
													</select>
												</p>
												<?php endif; ?>
											</td>
											<td>
												<strong class="sanpham-<?php echo $key; ?>"><?php echo number_format($value['soluong']*$value['price']*(100-$value['sale'])/100); ?>đ</strong>
											</td>
										</tr>
										<?php $tongtien += $value['soluong']*$value['price']*(100-$value['sale'])/100; ?>
									<?php endforeach; ?>
									<?php endif; ?>
									<tr>
										<td><a href="./" class="btn btn-sm btn-success">TIẾP TỤC MUA HÀNG</a> <a href="#thanhtoan" class="btn btn-sm btn-success">THANH TOÁN</a></td>
										<td></td><td></td>
										<td>Tổng tiền(<?php echo $tongsanpham; ?> sản phẩm):</td>
										<td><strong class="tongtien-card"><?php echo number_format($tongtien); ?>đ</strong></td>
									</tr>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
				<div class="sanphamhot danhmucsanpham">
					<div class="col-md-12 text-left">
						<div class="tieude giohang">
							<h3 id="thanhtoan">THÔNG TIN LIÊN HỆ</h3>
						</div>
					</div>

					<div class="col-md-12">
						<div class="col-md-8">
							<form method="POST" onsubmit="return false" class="form-horizontal" id="lienhegiohang">
								<div class="form-group">
									<label class="col-xs-3 control-label">Họ và tên (*)</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="name-card" placeholder="họ và tên">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Email (*)</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="email-card" placeholder="email">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Số điện thoại (*)</label>
									<div class="col-xs-9">
										<input type="number" class="form-control" name="phone-card" placeholder="số điện thoại">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-xs-3 control-label">Chọn tỉnh thành (*)</label>
									<div class="col-xs-9">
										<select class="form-control" name="province-card">
											<option value="-1"> -- Chọn tỉnh thành -- </option>
											<?php foreach (district_card() as $key => $value) : ?>
												<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Chọn quận huyện (*)</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="district-card" placeholder="chọn quận huyện">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Tên phường xã (*)</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="commune-card" placeholder="chọn phường xã">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Số nhà, tên đường (*)</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="number-card" placeholder="số nhà, tên đường">
										<span style="color: red; font-style: italic;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Ghi chú</label>
									<div class="col-xs-9">
										<textarea name="" id="" cols="30" rows="5" class="form-control" name="note-card" placeholder="..."></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-3 control-label">Hình thức thanh toán</label>
									<div class="col-xs-9">
										<select name="pay-card" class="form-control">
											<?php foreach (pay_card() as $key => $value) : ?>
												<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-3 col-xs-offset-3">
										<button class="btn btn-warning">GỬI ĐƠN HÀNG</button>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-9 col-xs-offset-3">
										<span class="thongbao"></span>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-4 lienhe">
							<div class="panel panel-default thanhtoan">
								<div class="panel-heading">
									<div class="panel-title text-center">Thanh toán tại văn phòng</div>
								</div>
								<div class="panel-body">
									<p>Hồ Chí Minh City, Co.Ltd</p>
									<p>Tòa nhà COCO</p>
								</div>
							</div>
							<div class="panel panel-default thanhtoan">
								<div class="panel-heading">
									<div class="panel-title text-center">Chuyển khoản ngân hàng</div>
								</div>
								<div class="panel-body">
									<p>1234567891011</p>
									<p>XP Bank chi nhánh Hồ Chí Minh</p>
									<p><a href="">Bạn đã chuyển khoản thanh toán?</a></p>
								</div>
							</div>
							<div class="panel panel-default thanhtoan">
								<div class="panel-heading">
									<div class="panel-title text-center">Thanh toán khi giao hàng</div>
								</div>
								<div class="panel-body">
									<p>Để được thanh toán tận nơi khi giao hàng, bạn vui lòng điền chính xác và đầy đủ thông tin như biểu mẫu chúng tôi đã đưa ra.</p>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require __DIR__.'/includes/footer.php'; ?>