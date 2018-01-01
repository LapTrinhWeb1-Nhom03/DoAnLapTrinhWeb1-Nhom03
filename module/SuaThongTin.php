<?php
    $ht =  $_SESSION["Thong_tin_user"]->Hoten;
    $dt = $_SESSION["Thong_tin_user"]->DienThoai;
    $gt = $_SESSION["Thong_tin_user"]->GioiTinh;
    $dc = $_SESSION["Thong_tin_user"]->DiaChi;
?>
<form name="fedit" method="post" action="" onsubmit="return KiemTraCapNhat()">
  <div class="row">
      <div class="col-md-offset-5">
        <div class="form-group">
          <h1 style="font-size: 20pt; color: blue;" ><span class="glyphicon glyphicon-user"></span> Chỉnh sửa thông tin </h1>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <label for="txtHoTen">Họ tên</label>
          <input type="text" class="form-control" maxlength="49" required name="txtHoTen" id="txtHoTen" value="<?=$ht ?>">
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <label for="txtDienThoai">Số điện thoại</label>
          <input type="text" class="form-control" maxlength="11" required name="txtDienThoai" id="txtDienThoai" value="<?=$dt ?>">
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <label for="sel1">Giới tính</label>
          <select name="sel1" id="sel1" class="form-control">
            <option><?=$gt?></option>
            <option><?php if($gt == "Nam"){echo "Nữ";} else {echo "Nam";}?></option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <label for="txtDiaChi">Địa chỉ</label>
          <textarea rows="2" class="form-control" maxlength="99" required name="txtDiaChi" id="txtDiaChi"><?=$dc; ?></textarea>
        </div>
      <button class="btn btn-success" type="submit" name="btnCNEdit"><span class="glyphicon glyphicon-pencil"></span> Chỉnh sửa</button>
      </div>
  </div>
</form>
<br>
<hr>