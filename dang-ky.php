﻿<?php
  
class GoogleRecaptcha 
{
    /* Google recaptcha API url */
    private $google_url = "https://www.google.com/recaptcha/api/siteverify";
    private $secret = 'YOUR_SECRET_KEY';
  
    public function VerifyCaptcha($response)
    {
        $url = $this->google_url."?secret=".$this->secret.
               "&response=".$response;
  
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, TRUE); 
        $curlData = curl_exec($curl);
  
        curl_close($curl);
  
        $res = json_decode($curlData, TRUE);
        if($res['success'] == 'true') 
            return TRUE;
        else
            return FALSE;
    }
  
}
  
$message = 'Google reCaptcha';
  
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $response = $_POST['g-recaptcha-response'];
  
    if(!empty($response))
    {
          $cap = new GoogleRecaptcha();
          $verified = $cap->VerifyCaptcha($response);
  
          if($verified) {
            $message = "Captcha Success!";
          } else {
            $message = "Please reenter captcha";
          }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng ký</title>
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
    <div class="col-md-12">
      <section>      
        <h1 class="entry-title"><span>Đăng ký</span> </h1>
        <hr>
            <form class="form-horizontal" method="post" name="username" id="username" enctype="multipart/form-data" >   
             <div class="form-group">
          <label class="control-label col-sm-3">Tên tài khoản <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" class="form-control" name="username" id="username" placeholder="Tạo tên tài khoản của bạn" value="">
            </div>
            </div>
        </div>    
        <div class="form-group">
          <label class="control-label col-sm-3">Email <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Nhập email của bạn" value="">
            </div>
            </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-3">Mật khẩu <span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu 6-15 ký tự" value="">
           </div>   
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Nhập lại mật khẩu <span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Nhập lại mật khẩu" value="">
            </div>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Họ tên <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
            <input type="text" class="form-control" name="mem_name" id="mem_name" placeholder="Nhập đầy đủ họ tên" value="">
          </div>
        </div>
          <div class="form-group">
          <label class="control-label col-sm-3">Địa chỉ <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
            <input type="text" class="form-control" name="dress" id="dress" placeholder="Nhập địa chỉ" value="">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Ngày sinh <span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select name="dd" class="form-control">
                	<option value="0">Ngày</option>
                <script type="text/javascript">
			for (var i = 1; i <= 31; i++) {
			    document.write('<option value="' + i + '">Ngày ' + i + '</option>');
			}
		</script>
              </select>
              </div>

               <div class="form-group">
                <select name="mm" class="form-control">
                	<option value="0">Tháng</option>
                <script type="text/javascript">
			for (var i = 1; i <= 12; i++) {
			    document.write('<option value="' + i + '">Tháng ' + i + '</option>');
			}
		</script>
              </select>
              </div>
              
              <div class="form-group" >
                <select name="yyyy" class="form-control">
                  <option value="0">Năm</option>
                  <script type="text/javascript">
			for (var i = 1957; i <= 2017; i++) {
			    document.write('<option value="' + i + '">' + i + '</option>');
			}
		</script>
                 </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Số điện thoại <span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          	<div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="text" class="form-control" name="contactnum" id="contactnum" placeholder="Nhập số điện thoại" value="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Giới tính <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
            <label>
            <input name="gender" type="radio" value="Male" checked>
            Nam </label>
               
            <label>
            <input name="gender" type="radio" value="Female" >
            Nữ </label>
          </div>
        </div>

           <div class="g-recaptcha" data-sitekey="6LfZszkUAAAAAGzybX9z7YiYmedR_Gej3HnbcTz-"></div> 

        
        <div class="form-group">
          <div class="col-xs-offset-3 col-xs-10">
            <input name="Submit" type="submit" value="Đăng ký" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
</div>
</div>
<div>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
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
</body>
</html>