<?php
class Cart extends Controller
{
    //Biến chứa carts_model
    private $cartModel;

    //Biến chứa danh sách thông tin book được lưu trong giỏ hàng
    private $listCartBook;

    function __construct()
    {
        //Khai báo model và khởi tạo model
        include("application/models/carts_model.php");
        $this->cartModel = new Carts();
    }

    function Index()
    {
        //Kiểm tra khi vào giỏ hàng nếu giỏ hàng trống quay lại trang home
        if(empty($_SESSION["cartBook"]))
        {
            header('Location: index.php?c=home');
            exit;
        }
        //----------------------------------------------------------------

        //Nếu giỏ hàng không trống thì tạo ra 2 biến 1 biến chứa danh sách book ID
        // và một biến chứa danh sách số lượng sách tương ứng với từng book id trong giỏ hàng
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
        //----------------------------------------------------------------------------------

        //Sau khi có danh sách book ID thì truyền vào model và model sẽ trả về để thông tin đầy đủ của từng cuốn sách
        $this->listCartBook = $this->cartModel->GetBookByMultipleID($listBookID);
        //----------------------------------------------------------------------------------------------------------

        //Truyền các sách và số lượng vào biến data
        $data = array("listCartBook"=>$this->listCartBook,"listBookQuality" => $listBookQuality);
        //-----------------------------------------


        //Khởi tạo các view sẽ được chạy
        $view = array("Index" => "Index");

        //-------------------------------

        //Khởi động view và truyền data vào view đó
        $this->View($view,$data);
        //--------------------------------
    }


    //Hàm này được kích hoạt khi người dùng nhấn vào giỏ hàng
    function AddSessionBookID()
    {
        //Lấy book id từ nút nhấn giỏ hàng
        $bookID = $_POST["id"];


        //Kiểm tra nếu giỏ hàng trống thì tạo ra giỏ hàng dạng array
        if(empty($_SESSION["cartBook"]))
        {
            $_SESSION["cartBook"] = array();
        }

        //Sau Khi tạo array cho giỏ hàng thì kiểm trả 1 lần nữa nếu giỏ hàng không có dữ liệu thì add vào
        if(empty($_SESSION["cartBook"])) {

            array_push($_SESSION["cartBook"],array(0=>$bookID,1=>1));
            echo count($_SESSION["cartBook"]);
        }
        else
        {
            //Đếm số lượng sách có trong giỏ hàng
            $count = count($_SESSION["cartBook"]);

            //Thuật toán thêm sách vào giỏ hàng khi giỏ hàng không trống
            for($i=0 ; $i < $count ; $i++)
            {

                if(empty($_SESSION["cartBook"][$i]))
                {

                    $count++;
                    continue;
                }

                if($bookID == $_SESSION["cartBook"][$i][0])
                {
                    $_SESSION["cartBook"][$i][1]++;
                    break;
                }

                if($i + 1 == $count)
                {
                    array_push($_SESSION["cartBook"],array(0=>$bookID,1=>1));
                    echo count($_SESSION["cartBook"]);
                }

            }
        }
    }

    //Xóa sách trong giỏ hàng
    function RemoveSessionBookID()
    {
        $count = count($_SESSION["cartBook"]);
        for($i = 0; $i < $count; $i++)
        {
            if(empty($_SESSION["cartBook"][$i]))
            {
                $count++;
                continue;
            }
            if($_POST["id"] == $_SESSION["cartBook"][$i][0])
            {
                unset($_SESSION['cartBook'][$i]);
                echo count($_SESSION["cartBook"]);
            }
        }

    }

    //Hàm này kích hoạt khi người dùng thay đổi số lượng sách trong giỏ hàng
    function UpdateSessionBookID()
    {
        $count = count($_SESSION["cartBook"]);
        for($i = 0; $i < $count; $i++)
        {
            if(empty($_SESSION["cartBook"][$i]))
            {
                $count++;
                continue;
            }

            if($_POST["id"] == $_SESSION["cartBook"][$i][0])
            {
                $_SESSION['cartBook'][$i][1] = $_POST['quality'];
                var_dump($_SESSION['cartBook'][$i][1]);
            }

        }
        echo count($_SESSION["cartBook"]);
    }

    //Hàm này dùng để tính tổng các sách khác nhau có trong giỏ hàng và show lên icon
    function CartTotal()
    {
        if(empty($_SESSION["cartBook"]))
        {
            echo 0;
        }
        else {
            $count = count($_SESSION["cartBook"]);
            echo count($_SESSION["cartBook"]);
        }
    }

    //Xóa hết trong giỏ hàng
    function DellAllSessionBookID()
    {
        unset($_SESSION["cartBook"]);
    }
}


?>