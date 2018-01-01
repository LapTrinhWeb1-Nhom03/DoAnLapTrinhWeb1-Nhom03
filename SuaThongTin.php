<?php
	include_once 'lib/db.php';
	session_start();
	if ($_SESSION["Da_Dang_Nhap"] ==0) {
		header('location: index.php');
	}
	if(isset($_POST["btnCNEdit"]))
	{
		$ht = $_POST["txtHoTen"];
		$dt = $_POST["txtDienThoai"];
		$gt = $_POST["sel1"];
		$dc = $_POST["txtDiaChi"];
		$uname = $_SESSION["Thong_tin_user"]->Username;
		$sql="update user set Hoten ='$ht',DienThoai = '$dt',GioiTinh = '$gt',DiaChi ='$dc' where username = '$uname'";
		write($sql);
		$sql = "select * from user where username = '$uname'";
		$load = load($sql);
		$_SESSION["Thong_tin_user"] = $load->fetch_object(); 
		echo '<script type="text/javascript">alert("Cập nhật thành công")</script>';
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
	}
	$tilte = "Thông tin cá nhân";
	include_once 'share/header.php';
	include_once 'module/SuaThongTin.php';
	include_once 'share/footer.php';