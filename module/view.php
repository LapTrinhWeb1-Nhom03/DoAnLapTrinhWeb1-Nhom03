<?php if($bool == 1):?>
<h2 class="title text-center"><?=$tennhasanxuat["TenNSX"]?></h2>
<div class="row" style="margin-top: 40px">
  <?php
      $sql = "select * from sanpham where NhaSX = $msx";
      $list = load($sql);
      while($row= $list->fetch_assoc()):
        $a = strlen($row["HinhAnh"]);
        $temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);//strpos lấy phía sau kí tự được chỉ định
        $thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
  ?>
  <div align="center" class="col-sm-4">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
        <h4><?=$row["TenSP"]?></h4>
        <h4>Giá bán: <?=number_format($row["Gia"])?></h4>
        <p><?=$row["MoTaNgan"]?></p>
          <div align="center">
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>#xemsanpham" class="btn btn-success" role="button">
              <span class="glyphicon glyphicon-ok"></span> Xem chi tiết</a>

              <a href="cart.php" class="btn btn-danger" role="button">
              <span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ</a>
           </div>
      </div>
    </div>
  </div>
    <?php endwhile; ?>
</div>
<?php endif;?>
<?php if($bool == 2):?>
<h2 class="title text-center"><?=$tenloai["TenLoai"]?></h2>
<div class="row" style="margin-top: 40px">
  <?php
      $sql = "select * from sanpham where LoaiSP = $ml";
      $list = load($sql);
      while($row= $list->fetch_assoc()):
        $a = strlen($row["HinhAnh"]);
        $temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);//strpos lấy phía sau kí tự được chỉ định
        $thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
  ?>
  <div class="col-sm-4">
    <div align="center" class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
        <h4><?=$row["TenSP"]?></h4>
        <h4>Giá bán: <?=number_format($row["Gia"])?></h4>
        <p><?=$row["MoTaNgan"]?></p>
        <div align="center">
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>#xemsanpham" class="btn btn-success" role="button">
              <span class="glyphicon glyphicon-ok"></span> Xem chi tiết</a>

              <a href="cart.php" class="btn btn-danger" role="button">
              <span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ</a>
           </div>
      </div>
    </div>
  </div>
    <?php endwhile; ?>
</div>
<?php endif;?>