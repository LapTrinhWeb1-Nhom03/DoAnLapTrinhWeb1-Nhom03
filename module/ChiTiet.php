<?php 
    $sql = "select * from sanpham where MaSP = $masanpham";
    $list = load($sql);
    $row= $list->fetch_assoc();
    $ml = $row["LoaiSP"];
    $mnsx = $row["NhaSX"];
    $l_sql = "select * from loaixe where MaLoai = $ml";
    $list_l = load($l_sql);
    $row_l= $list_l->fetch_assoc();
    $tenloai=$row_l["TenLoai"];
    $n_sql = "select * from nhasanxuat where MaNSX = $mnsx";
    $list_n = load($n_sql);
    $row_n= $list_n->fetch_assoc();
    $tennsx=$row_n["TenNSX"];
?>

<section>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 padding-right">
          <div class="product-details"><!--product-details-->
            <div class="col-sm-7">
              <div class="view-product">
                <img src="images/<?=$row["HinhAnh"]?>" alt="" />
              </div>
              <div id="similar-product" class="carousel slide" data-ride="carousel">
              </div>
            </div>
            <div class="col-sm-5">
              <div class="product-information"><!--/product-information-->
                <h1><?=$row["TenSP"]?></h1>
                <p><?=$row["MoTaDai"] ?></p>
                <span>
                  <h3>Giá: <?=number_format($row["Gia"])?> VNĐ</h3>
                <form method="post" action="addItemToCart.inc.php">
                  <div class="input-group">
                    <input type="hidden" name="txtProID" id="txtProID" value="<?= $_GET["MaSP"] ?>">
                    <ul>
                        <li>Chọn số lượng: <select style="margin-left: 10px;width: 80px;" value="1" name="txtQuantity" id="txtQuantity">
                        <?php 
                          for ($i=1; $i <=($row["SoLuongTon"]-$row["SoLuongBan"] ) ; $i++) { 
                         ?>
                            <option><?php echo "$i"; ?></option>
                        <?php
                          }
                         ?>
                  
                        </select></li>
                      </ul>
                    <span class="input-group-btn">
                     <button class="btn btn-success" type="submit" name="btnAddItemToCart">Thêm vào giỏ hàng</button>
                    </span>
                  </div>
                </form>
                </span>
                     <a href="view_cart.php"><button class="btn btn-danger" type="submit">Tiến hành thanh toán</button></a>
                <p><b>Số lượt xem: </b> <?=$row["LuotXem"] ?> </p>
                <p><b>Số lượng bán: </b> <?=$row["Soluongban"] ?> </p>
                <p><b>Xuất xứ: </b> <?=$row["XuatSu"] ?> </p>
                <p><b>Tên loại: </b> <?=$tenloai ?> </p>
                <p><b>Nhà sản xuất: </b> <?=$tennsx ?> </p>
              </div><!--/product-information-->
            </div>
          </div><!--/product-details-->
        </div>
      </div>
    </div>
  </section>


      <?php
      $sql = "select * from sanpham where MaSP = $masanpham";
      $list = load($sql);
      $row= $list->fetch_assoc();
  
      $ml = $row["LoaiSP"];
      $mnsx = $row["NhaSX"];
      $maloai = "select * from loaixe where MaLoai = $ml";
      $layloai = load($maloai);
      $tl = $layloai->fetch_assoc();
      $tenloai = $tl["TenLoai"];
      $manhasanxuat = "select * from nhasanxuat where MaNSX = $mnsx";
      $laynsx = load($manhasanxuat);
      $tnsx = $laynsx->fetch_assoc();
      $tennhasanxuat = $tnsx["TenNSX"];
      ?>
      <h2 class="title text-center">Sản phẩm cùng loại</h2>
  <div align="center" class="row">
  <?php
      $sql = "select * from sanpham where LoaiSP = $ml order by rand() limit 0,5";
      $list = load($sql);
      while($row= $list->fetch_assoc()):
        $a = strlen($row["HinhAnh"]);
        $temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);
        $thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
  ?>
  <div class="col-md-3">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
        <h4 style="height: 50px"><?=$row["TenSP"]?></h4>
        <h4><?=number_format($row["Gia"])?></h4>
        <p style="height: 30px"><?=$row["MoTaNgan"]?></p>
        <span>
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
           </span>
      </div>
    </div>
  </div>
    <?php endwhile; ?>
</div>
<h2 class="title text-center">Sản phẩm cùng nhà sản xuất</h2>
<div align="center" class="row">
  <?php
      $sql = "select * from sanpham where NhaSX = $mnsx order by rand() limit 0,5";
      $list = load($sql);
      while($row= $list->fetch_assoc()):
        $a = strlen($row["HinhAnh"]);
        $temp = substr($row["HinhAnh"],strpos($row["HinhAnh"],"/")+1);
        $thumuc = substr($row["HinhAnh"], 0,$a - strlen($temp)-1);
  ?>
  <div class="col-md-3">
    <div class="thumbnail">
      <img src="images/<?=$row["HinhAnh"]?>" alt="...">
      <div class="caption">
        <h4 style="height: 50px"><?=$row["TenSP"]?></h4>
        <h4><?=number_format($row["Gia"])?></h4>
        <p style="height: 30px"><?=$row["MoTaNgan"]?></p>
        <span>
              <a href="ChiTietSanPham.php?MaSP=<?=$row["MaSP"]?>#xemsanpham" class="btn btn-success" role="button">
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
           </span>
      </div>
    </div>
  </div>
    <?php endwhile; ?>
</div>