<?php
	// session_start();
include_once 'lib/db.php';
	session_start();
	$ht =  $_SESSION["Thong_tin_user"]->Hoten;
    $dt = $_SESSION["Thong_tin_user"]->DienThoai;
    $gt = $_SESSION["Thong_tin_user"]->GioiTinh;
    $dc = $_SESSION["Thong_tin_user"]->DiaChi;
	if ($_SESSION["Da_Dang_Nhap"] != 1) 
	{
		header('location: index.php');
	}
	if (!isset($_SESSION["Da_Dang_Nhap"])) {
		$_SESSION["Da_Dang_Nhap"] = 0;
	} 

	if ($_SESSION["Da_Dang_Nhap"] == 0) {
		if(isset($_SESSION["Thong_tin_user"])) {
			// tái tạo session
			$user_id = $_SESSION["Thong_tin_user"]->MaKH;
			$sql = "select * from user where MaKH = $user_id";
			$rs = load($sql);
			$_SESSION["Thong_tin_user"] = $rs->fetch_object();
			$_SESSION["Da_Dang_Nhap"] = 1;
			

		}

		// } else {
		// 	header("Location: dangnhap.php");
		// }
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Thông tin cá nhân</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    

<?php
    include_once 'share/header.php';
    ?>
</head>
<body>

     <h1 style="font-size: 24pt; color: blue; text-align: center;" ><span class="glyphicon glyphicon-user"></span> Trang cá nhân của bạn </h1></br>
	<div class="container">
      <div class="row">
       <div class="col-sm-12 padding-right">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Thông tin tài khoản</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Họ tên:</td>
                        <td><?=$ht ?></td>
                      </tr>
                      <tr>
                        <td>Số điện thoại:</td>
                        <td><?=$dt ?></td>
                      </tr>
                      <tr>
                        <td>Giới tính</td>
                        <td><?=$gt ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Địa chỉ</td>
                        <td><?=$dc ?></td>
                      </tr>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                      <span class="pull-right">
                       <a href="SuaThongTin.php" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa thông tin</a>
                   </span>
               </div>
          </div>
        </div>
      </div>
    </div>
    </br></br>

	<div class="container">
      <div class="row">
       <div class="col-sm-12 padding-right">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Lịch sử giao dịch</h3>
            </div>
          	  <div class="panel-body">
          	    <div class="row">
          	      <div class=" col-md-12 col-lg-12 "> 
           	       <table class="table table-user-information">
           	        <table class="table table-hover" style="margin-top: 20px">
						<thead>
						<tr>
							<th>Mã hóa đơn</th>
							<th>Khách hàng</th>
							<th>Ngày lập</th>
							<th class="col-md-3">Tổng tiền</th>
							<th>&nbsp;</th>
							</tr>
							</thead>
							<tbody>
							
          				  <?php
							$id = $_SESSION["Thong_tin_user"]->MaKH;
							$sql = "select * from hoadon where MaKH = $id";
							$rs = load($sql);
							if ($rs->num_rows > 0){ 
								while ($row = $rs->fetch_assoc()){
							?>

								<tr>
									<td>#<?= $row["MaHD"] ?></td>
									<td><?= $_SESSION["Thong_tin_user"]->Hoten ?></td>
									<td><?= $row["NgayLap"] ?></td>
									<td><?= number_format($row["TongTien"]) ?> VND</td>
									<!-- <td><?= $q ?></td> -->
									<td style="margin-right: -20px">
										<a class="hvr-shutter-in-vertical hvr-shutter-in-vertical2" style="margin-right: -95px;margin-left: 50px" href="detail-history.php?id=<?= $row["MaHD"] ?>" >
											Xem chi tiết</span>
										</a>
									</td>
									
								</tr>

							<?php 
								}
							}
							else{
								
							 ?>

   							   <div class="col-md-12">
  							      <div class="form-group">
  							      </br>
							          <p style=" color: red;" > Bạn chưa có lịch sử giao dịch nào, mời bạn <a href="index.php">mua hàng</a> </p>
						        </div>
						      </div>
							<?php
								} 
							 ?>
							</tbody>
						</table>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<div class="container" style="margin-top: 30px">
	</div>
	<?php
    include_once 'share/footer.php';
    ?>
</body>
</html>