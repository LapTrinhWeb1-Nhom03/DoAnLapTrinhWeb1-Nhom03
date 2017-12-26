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
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?=$tilte;?></title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/prettyPhoto.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css//price-range.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/responsive.css">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">	
</head>
<body class="bgpage">
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h2>BMW X6</h2>
									<p>Động cơ mạnh mẽ Công nghệ Efficient Dynamics. Hệ thống dẫn động toàn phần thông minh BMW xDrive.
								</p>
									<a href="ChiTietSanPham.php?MaSP=21"><button type="button" class="btn btn-default get">Xem chi tiết</button></a>
								</div>
								<div class="col-sm-6">
									<img src="images/home/xe1.jpg" class="girl img-responsive" alt="" />
									<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h2>Audi A8</h2>
									<p>Audi A8 luôn là mẫu xe giữ vị trí số một về doanh số bán hàng của dòng xe siêu sang chính hãng tại Việt Nam. </p>
									<a href="ChiTietSanPham.php?MaSP=19"><button type="button" class="btn btn-default get">Xem chi tiết</button></a>
								</div>
								<div class="col-sm-6">
									<img src="images/home/xe2.jpg" class="girl img-responsive" alt="" />
									<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h2>Mercedes G65 AMG</h2>
									<p>G65 AMG thuộc dòng xe địa hình, sở hữu kiểu dáng vuông vắn, góc cạnh nhưng không kém phần sang trọng. Là chiếc SUV mạnh mẽ hất thế giới </p>
									<a href="ChiTietSanPham.php?MaSP=9"><button type="button" class="btn btn-default get">Xem chi tiết</button></a>
								</div>
								<div class="col-sm-6">
									<img src="images/home/xe3.jpg" class="girl img-responsive" alt="" />
									<!-- <img src="images/home/pricing.png" class="pricing" alt="" /> -->
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<span class="glyphicon glyphicon-menu-left"></span>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<span class="glyphicon glyphicon-menu-right"></span>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/jquery.scrollUp.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/price-range.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/jquery.prettyPhoto.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/main.js"></script>
</body>
</html>