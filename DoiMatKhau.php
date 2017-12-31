<?php
	include_once 'lib/db.php';
	session_start();
	if ($_SESSION["Da_Dang_Nhap"] ==0) {
		header('location: index.php');
	}
	$mk = $_SESSION["Thong_tin_user"]->Password;
	$uname = $_SESSION["Thong_tin_user"]->Username;
	if (isset($_POST["btnMKEdit"])) {
		$mkc = $_POST["txtMKCu"];
		$mkc_mh = md5($mkc);
		if($mkc_mh == $mk)
		{
			$mkm = $_POST["txtMKmoi"];
			$mkm_mh = md5($mkm);
			$sql = "update user set Password = '$mkm_mh' where Username = '$uname'";
			write($sql);
			$sql = "select * from user where Username = '$uname'";
			$load = load($sql);
			$_SESSION["Thong_tin_user"] = $load->fetch_object();
			echo '<script type="text/javascript">alert("Đổi mật khẩu thành công")</script>';
		}
		else
		{
			echo '<script type="text/javascript">alert("Đổi mật khẩu thất bại")</script>';			
		}
	}
	$tilte = "Đổi mật khẩu";
	include_once 'share/header.php';
	include_once 'module/DoiMatKhau.php';
	include_once 'share/footer.php';