<?php
	if(!isset($_SESSION["Da_Dang_Nhap"]))
	{
		$_SESSION["Da_Dang_Nhap"] = 0;
	}
	if($_SESSION["Da_Dang_Nhap"]==0)
	{
		if(isset($_COOKIE["luu_Dang_nhap"]))
		{
			//tái tạo session
			$_SESSION["Da_Dang_Nhap"] = 1;
			$uname = $_COOKIE["luu_Dang_nhap"];
			$sql = "select * from user where Username = '$uname'";
			$li = load($sql);
			$_SESSION["Thong_tin_user"] = $li->fetch_object();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$tilte;?></title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/prettyPhoto.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css//price-range.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/responsive.css">
	
</head>
<body class="bgpage">
<div class="container">
	
	<!-- <?php include_once $edit;
	 ?> -->
	

	<div class="header-middle"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" width="140" height="40" alt="" /></a>
						</div>
					</div>
					<h1>
					<div class="mainmenu pull-right">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href=""><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng(0)</a></li>
								<li class="dropdown">
									<?php if($_SESSION["Da_Dang_Nhap"]==1) :?>
									<a href="profile.php"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION["Thong_tin_user"]->Hoten;?></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</a></li>
										<li><a href="DoiMatKhau.php"><span class="glyphicon glyphicon-lock"></span> Đổi mật khẩu</a></li> 
										<li><a href="Logout.php"><span class="glyphicon glyphicon-off"></span> Đăng xuất</a></li> 
                                    </ul>
                                     <?php endif; if($_SESSION["Da_Dang_Nhap"]==0) :?>
			        <a href="Login.php"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
		        <?php endif;?>
                                </li>
							</ul>
						</div>
						</h1>
				</div>
			</div>
		</div><!--header_top-->
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
								<li class="dropdown"><a href="#">Thương hiệu</a>
                                 <ul role="menu" class="sub-menu">
                        <?php
	          				$sql = "select * from nhasanxuat";
	          				$list = load($sql);
	          				while($row = $list->fetch_assoc()): 
	          			?>
	            <li><a href="view.php?MaNSX=<?=$row["MaNSX"]?>#xemsanpham"><?= $row["TenNSX"] ?></a></li>
	            <?php endwhile; ?> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Loại xe</a>
                                    <ul role="menu" class="sub-menu">
                                       	<?php
	          		$sql = "select * from loaixe";
	          		$list = load($sql);
	          		while($row = $list->fetch_assoc()): 
	          	?>
	            <li><a href="view.php?MaLoai=<?=$row["MaLoai"]?>#xemsanpham"><?= $row["TenLoai"] ?></a></li>
	            <?php endwhile; ?>
                     </ul>
                    </li> 
				</ul>
			</div>
		</div>
		 <div class="search">
	    	 <form class="navbar-form navbar-left" name="fsearch" id="fsearch" method="POST" action="TimKiemSanPham.php#xemsanpham">
	       		 <div class="form-group">
	   		        <input type="text" class="form-control" placeholder="Tên sản phẩm..." name="txtSearch" id="txtSearch">
	   			   </div>
	  			      <button class="btn btn-default" type="submit" name="btnSearch" id="btnSearch">
	  			    	<i class="glyphicon glyphicon-search"></i>
	  			    </button>
	    		 	  </form>	
  				 </div>
			</div>
			</div>
		<hr/>
</div><!--/header-bottom-->

	<!-- banner-->

	
	<!-- <?php include_once $body; ?> -->
</div>
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/jquery.scrollUp.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/price-range.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/jquery.prettyPhoto.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/main.js"></script>
	<script type="text/javascript">
		var ht = fedit.txtHoTen.value;
		var ngay = fedit.ngay.value;
		var thang =fedit.thang.value;
		var nam = fedit.nam.value;
		var gt = fedit.sel1.value;
		var cmt = fedit.txtCMND.value;
		var dc = fedit.txtDiaChi.value;
		function KiemTraCapNhat() {
			if(fedit.txtHoTen.value == "")
			{
				alert("Họ tên không được để trống");
				return false;
			}
			if(fedit.ngay.value == ngay && fedit.thang.value == thang && fedit.nam.value == nam && fedit.txtHoTen.value == ht && fedit.sel1.value == gt && fedit.txtCMND.value == cmt && fedit.txtDiaChi.value == dc)
			{
				alert("Không có gì được thay đổi");
				return false;
			}
			if(isNaN(fedit.txtCMND.value))
			{
				alert("Chứng minh thư không hợp lệ");
				return false;
			}
			return true;
		}
		function KiemTraDMK()
		{
			if(feditmk.txtMKCu.value == "")
			{
				alert("Chưa nhập mật khẩu cũ");
				return false;
			}
			if(feditmk.txtMKmoi.value.length < 6)
			{
				alert("Mật khẩu mới quá ngắn");
				return false;
			}
			if(feditmk.txtMKCu.value == feditmk.txtMKmoi.value)
			{
				alert("Mật khẩu mới trùng mật khẩu cũ");
				return false;
			}
			if(feditmk.txtMKmoi.value != feditmk.txtLapMKmoi.value)
			{
				alert("Mật khẩu lặp lại không đúng");
				return false;
			}
			return true;
		}
	</script>
</body>
</html>