<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
 <?php
  include("module/header.php");
  ?>  
  <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="images/home/login.png" alt="">
                <form class="form-signin">
                <input type="text" class="form-control" placeholder="Email" required autofocus>
              </br>
                <input type="password" class="form-control" placeholder="Mật khẩu" required>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Nhớ mật khẩu
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Đăng nhập</button>
                </form>
            </div>
          </br> </br> </br>
        </div>
    </div>
</div>

  <?php 
    include("module/footer.php");
   ?>


 <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
  <script src="js/dangnhap.js"></script>
</body>
</html>