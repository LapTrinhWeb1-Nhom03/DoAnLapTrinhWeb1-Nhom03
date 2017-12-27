<h2 class="title text-center">Kết quả tìm kiếm</h2>
<div class="row" style="margin-top: 40px">
	<?php
    if($bool == 1)
    {
      if($timkiem == "")
      {
        $sql = "select * from sanpham";
      }
      else
      {
		    $sql = "select * from sanpham where TenSP like '%$timkiem%'";
      }
    }
    if($bool == 2)
    {
      $sql = "select * from sanpham order by gia asc";
    }
    if ($bool == 3) 
    {
      $sql = "select * from sanpham where gia >= $giatu and gia <= $giaden and NhaSX = $nsx and LoaiSP = $lx order by gia asc";
    }
    if($bool == 4)
    {
      $sql = "select * from sanpham where gia >= $giatu order by gia asc";
    }
    if($bool == 5)
    {
      $sql = "select * from sanpham where gia <= $giaden order by gia asc";
    }
    if($bool == 6)
    {
      $sql = "select * from sanpham where NhaSX = $nsx order by gia asc";
    }
    if($bool == 7)
    {
      $sql = "select * from sanpham where LoaiSP = $lx order by gia asc";
    }
    if($bool == 8)
    {
      $sql = "select * from sanpham where gia >= $giatu and gia <= $giaden order by gia asc";
    }
    if($bool == 9)
    {
      $sql = "select * from sanpham where gia >= $giatu and NhaSX = $nsx order by gia asc";
    }
    if($bool == 10)
    {
      $sql = "select * from sanpham where gia >= $giatu and LoaiSP = $lx order by gia asc";
    }
    if($bool == 11)
    {
      $sql = "select * from sanpham where gia <= $giaden and NhaSX = $nsx order by gia asc";
    }
    if($bool == 12)
    {
      $sql = "select * from sanpham where gia <= $giaden and LoaiSP = $lx order by gia asc";
    }
    if($bool == 13)
    {
      $sql = "select * from sanpham where NhaSX = $nsx and LoaiSP = $lx order by gia asc";
    }
    if($bool == 14)
    {
       $sql = "select * from sanpham where gia >= $giatu and gia <= $giaden and NhaSX = $nsx order by gia asc";
    }
    if($bool == 15)
    {
       $sql = "select * from sanpham where gia >= $giatu and gia <= $giaden and LoaiSP = $lx order by gia asc";
    }
    if($bool == 16)
    {
       $sql = "select * from sanpham where gia <= $giaden and NhaSX = $nsx and LoaiSP = $lx order by gia asc";
    }
    $list = load($sql);
    $sodong = $list->num_rows;
    if($sodong > 0):
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
  	<?php 
      endwhile; 
      else :
    ?>
     <p style="font-size: 16pt; color: red;" class="text-center" > Không có sản phẩm thỏa điều kiện </p>
  </br></br></br></br></br></br></br></br></br></br></br></br>
    <?php endif; ?>
</div>