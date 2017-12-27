<?php
	session_start();
	include_once 'lib/db.php';
	include_once 'vendor/autoload.php';
	use Gregwar\Captcha\CaptchaBuilder;

	if($_SESSION["Da_Dang_Nhap"]==1)
	{
		header('location: index.php');
	}
	if (isset($_POST["btnDangKi"])) 
	{
		$input = $_POST["maxacnhan"];
		if($input != $_SESSION["captcha"])
		{
			echo '<script type="text/javascript">alert("Mã xác nhận không hợp lệ")</script>';
		} 
		else
		{
			$tendangnhap = $_POST["tendangnhap"];
			$sql = "select * from user where username = '$tendangnhap'";
			$load = load($sql);
			if($load->num_rows > 0)
			{
				echo '<script type="text/javascript">alert("Tên đăng nhập đã tồn tại")</script>';
			}
			else{
				$hoten = $_POST["hoten"];
				$gt = $_POST["sel1"];
				$us = $_POST["tendangnhap"];
				$ad = $_POST["diachi"];
				$dt = $_POST["sdt"];
				$pw = $_POST["matkhau"];
				$pw_mh = md5($pw);
				$sql = "insert into user(username,password,hoten,gioitinh,diachi,DienThoai) values('$us','$pw_mh','$hoten','$gt','$ad','$dt')";
				write($sql);
				echo '<script type="text/javascript">alert("Đăng kí thành công")</script>';
			}
				
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng kí</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
	<?php
	include_once 'share/header.php';
	?>
	<div class="container">
		<div class="col-md-4 col-md-offset-4">
				<h1 style="font-size: 24pt; color: blue;" ><span class="glyphicon glyphicon-user"></span> Đăng ký tài khoản</h1>
				<form method="post" action="" name="fdangki" id="fdangki" onsubmit="return KiemTra()">
				  <div class="form-group">
				    <label for="hoten">Họ và tên</label>
				    <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Nhập họ tên đầy đủ" required maxlength="49">
				  </div>
				  <div class="form-group">
				    <label for="tendangnhap">Tên đăng nhập</label>
				    <input type="text" class="form-control"  name="tendangnhap" id="tendangnhap" placeholder="Tên dùng để đăng nhập" required maxlength="29">
				  </div>
				  <div class="form-group">
				    	<label for="sel1">Giới tính</label>
			        	<select class="form-control" id="sel1" name="sel1">
						    <option>Nam</option>
						    <option>Nữ</option>
			        	</select>
				  </div>
				   <div class="form-group">
				    <label for="tendangnhap">Địa chỉ</label>
				    <input type="text" class="form-control"  name="diachi" id="diachi" placeholder="Địa chỉ để chúng tôi giao hàng" required >
				  </div>
				   <div class="form-group">
				    <label for="tendangnhap">Số điện thoại</label>
				    <input type="text" class="form-control"  name="sdt" id="sdt" placeholder="Số điện thoại của bạn" required maxlength="11">
				  </div>
				  <div class="form-group">
				    <label for="matkhau">Mật khẩu</label>
				    <input type="password" class="form-control" name="matkhau" id="matkhau" placeholder="******" required maxlength="20">
				  </div>
				  <div class="form-group">
				    <label for="lapmatkhau">Nhập lại mật khẩu</label>
				    <input type="password" class="form-control" name="lapmatkhau" id="lapmatkhau" placeholder="******" required maxlength="20">
				  </div>
				  <div class="form-group">
				    <label for="maxacnhan">Xác nhận capcha</label>
				    <br/>
						<?php
							$builder = new CaptchaBuilder;
							$builder->build();
							$_SESSION["captcha"] = $builder->getPhrase();//lấy kí tự
						?>
						<img src="<?= $builder->inline() ?>"/>
				    <input type="text" class="form-control" name="maxacnhan" id="maxacnhan" placeholder="Nhập lại mã phía trên" maxlength="11">
				  </div>
				  <button type="submit" class="btn btn-success" name="btnDangKi"> Đăng kí </button>
				  <p><a href="Login.php"></br>Đã có tài khoản?</a></p>
				</form>
		<hr/>
		</div>
	</div>
	<?php
	include_once 'share/footer.php';
	?>
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function KiemTra() {
			if(fdangki.hoten.value.length == 0)
			{
				alert("Chưa nhập họ tên,đăng kí thất bại");
				return false;
			}
			if (fdangki.tendangnhap.value.length == 0) {
				alert("Vui lòng điền tên đăng nhập");
				return false;
			}
			if (fdangki.matkhau.value.length == 0) {
				alert("Vui lòng nhập mật khẩu");
				return false;
			}
			if(fdangki.lapmatkhau.value != fdangki.matkhau.value)
			{
				alert("Mật khẩu lặp lại không đúng");
				return false;
			}
			return true;
		}
	</script>
</body>
</html>