<?php
	include_once 'lib/db.php';
	include_once 'cart.inc';
	include_once 'vendor/autoload.php';
	use Gregwar\Captcha\CaptchaBuilder;
	if(!isset($_SESSION["SoLanDangNhapSai"]))
	{
		$_SESSION["SoLanDangNhapSai"] = 0;
	}
	if ($_SESSION["Da_Dang_Nhap"] == 1) 
	{
		header('location: index.php');
	}
	if(isset($_POST["btnDangNhap"]))
	{
		if($_SESSION["SoLanDangNhapSai"] >=3)
		{
			$input = $_POST["maxacnhan"];
			if($_SESSION["captchadn"] != $input)
			{
				$_SESSION["SoLanDangNhapSai"] +=1;
				echo '<script type="text/javascript">alert("Mã xác nhận không hợp lệ")</script>';
			}
		}
		if($_SESSION["SoLanDangNhapSai"] < 3 || $_SESSION["captchadn"] == $input)
		{
			$username = $_POST["tendangnhap"];
			$password = $_POST["matkhau"];
			$password_mh = md5($password);
			$sql = "select * from user where Username = '$username' and Password = '$password_mh'";
			$list = load($sql);
			if($list->num_rows > 0)
			{
				$_SESSION["SoLanDangNhapSai"] = 0;
				$_SESSION["Da_Dang_Nhap"] = 1;
				$_SESSION["Thong_tin_user"] = $list->fetch_object();
				//lưu cookie
				if(isset($_POST["cbGhinho"]))
				{
					$user_name = $_SESSION["Thong_tin_user"]->Username;
					setcookie("luu_Dang_nhap",$user_name,time()+3600);
				}
				header('location: index.php');
			}
			else{
					$_SESSION["SoLanDangNhapSai"] += 1;
					echo '<script type="text/javascript">alert("Tên đăng nhập hoặc mật khẩu không đúng")</script>'; 
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
<?php
	include_once 'share/header.php';
?>
	<div class="container">
		<div class="col-md-4 col-md-offset-4">
            <img id="profile-img" width="100" height="100" hspace="120" class="profile-img-card" src="images/home/login.png" />
            <p id="profile-name" class="profile-name-card"></p>
				<form method="post" action="" name="fdangnhap" onsubmit="return KiemTraDangNhap()">
				  <div class="form-group">
				    <label for="tendangnhap">Tên đăng nhập</label>
				    <input type="text" class="form-control"  name="tendangnhap" id="tendangnhap" placeholder="Tên đăng nhập" required>
				  </div>
				  <div class="form-group">
				    <label for="matkhau">Mật khẩu</label>
				    <input type="password" class="form-control" name="matkhau" id="matkhau" placeholder="******" required>
				  </div>
				  <?php if($_SESSION["SoLanDangNhapSai"] >= 3): ?>
				  <div class="form-group">
				    <label for="maxacnhan">Mã xác nhận</label>
				    <br/>
						<?php
							$builder = new CaptchaBuilder;
							$builder->build();
							$_SESSION["captchadn"] = $builder->getPhrase();//lấy kí tự
						?>
						<img src="<?= $builder->inline() ?>"/>
				    <input type="text" class="form-control" name="maxacnhan" id="maxacnhan" placeholder="" maxlength="11">
				  </div>
				  <?php endif;?>
				  <div class="checkbox">
				    <label>
				      <input type="checkbox" name="cbGhinho"> Nhớ mật khẩu?
				    </label>
				  </div>
				  <button type="submit" class="btn btn-success" name="btnDangNhap">Đăng nhập</button>
					<p><a href="DangKi.php"></br>Chưa có tài khoản?</a></p>
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
		function KiemTraDangNhap() {
			if(fdangnhap.tendangnhap.value == "")
			{
				alert("Chưa nhập họ tên");
				return false;
			}
			if (fdangnhap.matkhau.value == "")
			{
				alert("Chưa nhập mật khẩu");
				return false;
			}
			return true;
		}
	</script>
</body>
</html>