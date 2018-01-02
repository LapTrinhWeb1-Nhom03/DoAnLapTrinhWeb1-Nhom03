<?php
    require_once "lib/db.php";
    require_once 'cart.inc';
    if (isset($_POST["btnCheckOut"])) {
        $o_Total = $_POST["txtTotal"];
        $o_UserID = $_SESSION["Thong_tin_user"]->MaKH;
        $o_OrderDate = strtotime("+7 hours", time());
        $str_OrderDate = date("Y-m-d H:i:s", $o_OrderDate);
        $sql = "insert into hoadon(MaKH, TongTien, NgayLap) values(\"$o_UserID\", \"$o_Total\", \"$str_OrderDate\")";
        $o_ID = insertRow($sql);

        //
        // order_details

        foreach ($_SESSION["cart"] as $proId => $q) {
            $sql = "select * from sanpham where MaSP = $proId";
            $rs = load($sql);
            $row = $rs->fetch_assoc();
            $price = $row["Gia"];
            $amount = $q * $price;
            $d_sql = "insert into cthoadon(MaHD, MaSP, SoLuong, DonGia, ThanhTien) values(\"$o_ID\", \"$proId\", \"$q\", \"$price\", \"$amount\")";
            $u_sql = "update sanpham set SoLuongBan = SoLuongBan +$q where MaSP = $proId";
            $slt_sql = "update sanpham set SoLuongTon = SoLuongTon - $q where MaSP = $proId";
            write($d_sql);
            write($u_sql);
            write($slt_sql);
        }

        //
        // clear cart
        
        $_SESSION["cart"] = array();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    

<?php
    include_once 'share/header.php';
    ?>
<body>




</br></br>
    <?php
        if(get_total_items()==0)
        {
            echo '<div class="col-md-offset-5">';
            echo '<div class="form-group">';
            echo '<h1 style="font-size: 24pt; color: red;" > Giỏ hàng trống </h1>';
            echo  '</div>';
            echo '</div>';
            echo '<div class="col-md-offset-5">';
             echo  ' <div class="form-group">';
             echo '<img src="images/home/cart-empty.png">';
              echo    '  <h1 style="font-size: 18pt; color: red;" ><a href="Index.php"> Mời bạn mua hàng</a> </h1>';
              echo ' </div>';
            echo '</div>';
            echo '</br></br></br></br>';
            echo '<script type="text/javascript"> $(document).ready(function(){$("#hidden_cart").hide();});</script>';
        }
        
    ?>
    <div class="container-fluid" id="hidden_cart">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="col-md-offset-5">
                <div class="form-group">
            <h1 style="font-size: 24pt; color: blue;" > Giỏ hàng của bạn </h1>
                </div>
                </div>
                    <div class="panel-body">
                        <form id="f" method="post" action="updateCart.inc.php">
                            <input type="hidden" id="txtCmd" name="txtCmd">
                            <input type="hidden" id="txtDProId" name="txtDProId">
                            <input type="hidden" id="txtUQ" name="txtUQ">
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th class="col-md-1">Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION["cart"] as $proId => $q) :
                                $sql = "select * from sanpham where MaSP = $proId";
                                $rs = load($sql);
                                $row = $rs->fetch_assoc();
                                $amount = $q * $row["Gia"];
                                $total += $amount;
                            ?>
                                <tr>
                                    <td><?= $row["TenSP"] ?></td>
                                    <td><?= number_format($row["Gia"]) ?></td>
                                    <!-- <td><?= $q ?></td> -->
                                    <td>
                                        <input class="quantity-textfield" type="text" name="" id="" value="<?= $q ?>">
                                    </td>
                                    <td> <?= number_format($amount) ?></td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-danger cart-remove" data-id="<?= $proId ?>" href="javascript:;" role="button">
                                            Xóa khỏi giỏ hàng
                                        </a>
                                         <a class="btn btn-xs btn-success cart-update" data-id="<?= $proId ?>" href="javascript:;" role="button">
                                            Cập nhật sản phẩm</span>
                                        </a>

                                        
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                            <tfoot>
                                <td>
                                    <a class="btn btn-success" href="index.php" role="button">
                                        Tiếp tục mua hàng
                                    </a>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><b>Tổng tiền hóa đơn: <?= number_format($total) ?></b></td>
                                <td class="text-right">
                                    
                                    <form method="POST" action="">
                                        <input type="hidden" name="txtTotal" value="<?= $total ?>">
                                        <?php 
                                            if ($_SESSION["Da_Dang_Nhap"] !=1) {
                            
                                         ?>
                                        <a href="Dangnhap.php" class="btn btn-primary " type="submit" name="btnAddItemToCart">
                                            Thanh toán
                                        </a>
                                        <?php
                                            } 
                                         ?>

                                         <?php 
                                            if ($_SESSION["Da_Dang_Nhap"] ==1) {
                            
                                         ?>
                                        <button name="btnCheckOut" id="report" type="submit" class="btn btn-primary">
                                            Đặt hàng
                                        </button>
                                        <?php
                                            } 
                                         ?>
                                    </form>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once 'share/footer.php';
    ?>
    <script src="assets/jquery-3.1.1.min.js"></script>
    <script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script type="text/javascript">
        $('.cart-remove').on('click', function() {
            var id = $(this).data('id');
            $('#txtDProId').val(id);
            $('#txtCmd').val('D');
            $('#f').submit();
        });

        $('.cart-update').on('click', function() {

            var q = $(this).closest('tr').find('.quantity-textfield').val();
            $('#txtUQ').val(q);

            var id = $(this).data('id');
            $('#txtDProId').val(id);
            $('#txtCmd').val('U');

            $('#f').submit();
        });

        $('.quantity-textfield').TouchSpin({
            min: 1,
            max: 69,
            verticalbuttons: true,
            // step: 1,
            // decimals: 0,
            // boostat: 5,
            // maxboostedstep: 10,
            // postfix: '%'
        });

        $(document).ready(function(){
            $("#report").click(function(){
                alert("Chúc mừng bạn đã thanh toán thành công");
            })
        })
    </script>
</body>
</html>