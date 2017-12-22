<?php
class Checkout extends Controller
{

    private $listCartBook;
    private $cartModel;
    private $maxInvoiceID;

    function __construct()
    {
        include("application/models/carts_model.php");

        $this->cartModel = new Carts();
    }

    function Index()
    {


        //Kiểm tra nếu chưa chọn loại thanh toán hay danh sách giỏ hàng trống thì ...
        if(empty($_GET["checkoutType"]) || empty($_SESSION["cartBook"])) {
            header('Location: index.php?c=cart');
            exit;
        }

        //Nếu chọn loại thanh toán theo tài khoản thì chuyển sang login cho người dùng đăng nhập
        $checkoutType = $_GET["checkoutType"];
        if(intval($_GET["checkoutType"]) == 2)
        {
            if(empty($_SESSION["userInfo"]))
            {
                header('Location: index.php?c=login&redirect=cart');
                exit;
            }
            else
            {

            }
        }

        //Thuật toán truyền dữ liệu session vào biến listbookid và listbookquality qqua invoice
        $listBookID = array();
        $listBookQuality = array();
        $count = count($_SESSION["cartBook"]);
        for($i = 0; $i < $count; $i++)
        {
            if(empty($_SESSION["cartBook"][$i]))
            {
                $count++;
                continue;
            }
            $listBookID[] = $_SESSION["cartBook"][$i][0];
            $listBookQuality[] = $_SESSION["cartBook"][$i][1];
        }
        //--------------------------------------------------------------------------------------

        $this->listCartBook = $this->cartModel->GetBookByMultipleID($listBookID);
        $this->maxInvoiceID = $this->cartModel->GetMaxID();
        $data = array("checkoutType" => $checkoutType,"listCartBook" =>$this->listCartBook,"maxInvoiceID"=>$this->maxInvoiceID,"listBookQuality" => $listBookQuality);
        $view = array("Index" => "Index");
        $this->View($view,$data);
    }
}
?>