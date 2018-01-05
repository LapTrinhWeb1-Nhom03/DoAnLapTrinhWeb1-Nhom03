<h2 class="title text-center">Sản phẩm mới nhất</h2>
<div class="row" style="margin-top: 40px">
	<?php
		$sql = "select * from sanpham ORDER BY NgayTiepNhan DESC LIMIT 0,10";
		$list = load($sql);
		while($row= $list->fetch_assoc()):
			$a = strlen($row["HinhAnh"]);
			$temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);//strpos lấy phía sau kí tự được chỉ định
			$thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
	?>
  <div align="center" class="col-sm-3">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
      	<h4><?=$row["TenSP"]?></h4>
        <h4>Giá bán: <?=number_format($row["Gia"])?></h4>
        <p><?=$row["MoTaNgan"]?></p>
        <div align="center">
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>" class="btn btn-success" role="button">
              <span class="glyphicon glyphicon-ok"></span> Chi tiết sản phẩm</a>
              <form method="post" action="addItemToCart.inc.php">
                  <div class="input-group">
                    <input type="hidden" name="txtProID" id="txtProID" value="<?= $row["MaSP"]?>">
                    <input type="hidden" name="txtQuantity" id="txtQuantity" value="1">
                    
                    <span class="input-group-btn">
                     <button class="btn btn-danger" type="submit" name="btnAddItemToCart">Thêm vào giỏ hàng</button>
                    </span>
                  </div>
                </form>
           </div>
      </div>
    </div>
  </div>
  	<?php endwhile; ?>
</div>
<h2 class="title text-center">Sản phẩm bán chạy nhất</h2>
<div class="row" style="margin-top: 40px">
	<?php
		$sql = "select * from sanpham ORDER BY Soluongban DESC LIMIT 0,10";
		$list = load($sql);
		while($row= $list->fetch_assoc()):
			$a = strlen($row["HinhAnh"]);
			$temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);
			$thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
	?>
  <div align="center" class="col-sm-3">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
      	<h4><?=$row["TenSP"]?></h4>
        <h4>Giá bán: <?=number_format($row["Gia"])?></h4>
        <p><?=$row["MoTaNgan"]?></p>
        <div align="center">
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>" class="btn btn-success" role="button">
              <span class="glyphicon glyphicon-ok"></span> Xem chi tiết</a>
              <form method="post" action="addItemToCart.inc.php">
                  <div class="input-group">
                    <input type="hidden" name="txtProID" id="txtProID" value="<?= $row["MaSP"]?>">
                    <input type="hidden" name="txtQuantity" id="txtQuantity" value="1">
                    
                    <span class="input-group-btn">
                     <button class="btn btn-danger" type="submit" name="btnAddItemToCart">Thêm vào giỏ</button>
                    </span>
                  </div>
                </form>
           </div>
      </div>
    </div>
  </div>
  	<?php endwhile; ?>
</div>
<h2 class="title text-center">Sản phẩm được xem nhiều nhất</h2>
<div class="row" style="margin-top: 40px">
	<?php
		$sql = "select * from sanpham ORDER BY LuotXem DESC LIMIT 0,10";
		$list = load($sql);
		while($row= $list->fetch_assoc()):
			$a = strlen($row["HinhAnh"]);
			$temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);
			$thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
	?>
  <div align="center" class="col-sm-3">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
      	<h4><?=$row["TenSP"]?></h4>
        <h4>Giá bán: <?=number_format($row["Gia"])?></h4>
        <p><?=$row["MoTaNgan"]?></p>
        <div align="center">
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>" class="btn btn-success" role="button">
              <span class="glyphicon glyphicon-ok"></span> Xem chi tiết</a>
              <form method="post" action="addItemToCart.inc.php">
                  <div class="input-group">
                    <input type="hidden" name="txtProID" id="txtProID" value="<?= $row["MaSP"]?>">
                    <input type="hidden" name="txtQuantity" value="1">
                    
                    <span class="input-group-btn">
                     <button class="btn btn-danger" type="submit" name="btnAddItemToCart">Thêm vào giỏ</button>
                    </span>
                  </div>
                </form>
           </div>
      </div>
    </div>
  </div>
  	<?php endwhile; ?>
</div>
