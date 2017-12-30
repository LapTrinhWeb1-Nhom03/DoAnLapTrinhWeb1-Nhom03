<?php
	session_start();
	if (isset($_SESSION["Da_Dang_Nhap"])) {
		unset($_SESSION["Da_Dang_Nhap"]);
		unset($_SESSION["Thong_tin_user"]);
		// unset($_SESSION["SoLanDangNhapSai"]);

		setcookie("luu_Dang_nhap","",time()-3600);
	}
	header('location: index.php');