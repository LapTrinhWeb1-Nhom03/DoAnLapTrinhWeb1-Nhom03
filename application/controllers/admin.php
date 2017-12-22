<?php
class Admin extends Controller
{
    private $adminModel;
    private $detailModel;
    private $bookID;
    private $bookInfoByID;
    function __construct()
    {
        include("application/models/admins_model.php");
        include("application/models/detail_model.php");
        $this->adminModel = new Admins();
        $this->detailModel = new Details();
    }


    function Index()
    {
        if(empty($_SESSION["userInfo"]))
        {
            header('Location: index.php?c=login');
            exit;
        }

        if($_SESSION["userInfo"][0]->POSITION != "admin")
        {
            header('Location: index.php?c=home');
            exit;
        }


        $view = array("Index" => "Index");
        $this->View($view);
    }

    function AddBook()
    {
        $status = "";
        if(empty($_SESSION["userInfo"]))
        {
            header('Location: index.php?c=login');
            exit;
        }

        if($_SESSION["userInfo"][0]->POSITION != "admin")
        {
            header('Location: index.php?c=home');
            exit;
        }

        if(!empty($_POST["addBook"]))
        {
            $bookName = $_POST["bookName"];
            $description = $_POST["description"];
            $status = $_POST["status"];
            $category = $_POST["category"];

            $image =  $_FILES['image']['name'];
            if(!empty($image))
            {
                $this->UploadImage("image");
            }

            $image1 = $_FILES['image1']['name'];
            if(!empty($image1))
            {
                $this->UploadImage("image1");
            }
            $bookCost = $_POST["bookCost"];
            $bookOldCost = $_POST["bookOldCost"];


            $result = $this->adminModel->AddBook($bookName,$description,$status,$category,$image,$image1,$bookCost,$bookOldCost);
            $updateBookNo = $this->adminModel->UpdateBookNo();
            $status= "<style>label{color:green;}</style>Thêm thành công";
        }

        $data = array("status"=>$status);
        $view = array("add_book" => "add_book");
        $this->View($view,$data);
    }

    function UpdateBook()
    {
        $status = "";
        if(empty($_SESSION["userInfo"]))
        {
            header('Location: index.php?c=login');
            exit;
        }

        if($_SESSION["userInfo"][0]->POSITION != "admin")
        {
            header('Location: index.php?c=home');
            exit;
        }

        if(!empty($_POST["findBook"]))
        {

            $this->bookID = $_POST["bookID"];
            $this->bookInfoByID = $this->detailModel->GetBookDetailByID($this->bookID);
            if(!empty($this->bookInfoByID))
            {
                $status = "<style>.check{color:green;}</style>Hợp lệ";
            }
            else
            {
                $status = "<style>.check{color:red;}</style>Không tìm thấy sách yêu cầu";
            }


        }

        if(!empty($_POST["updateBook"]))
        {
            $this->bookInfoByID = $this->detailModel->GetBookDetailByID($_POST["bookID"]);
            $bookName = $_POST["bookName"];
            $description = $_POST["description"];
            $status = $_POST["status"];
            $category = $_POST["category"];

            $image =  $_FILES['image']['name'];
            if($image != "")
            {
                $this->UploadImage("image");
            }
            else
            {
                $image = $this->bookInfoByID[0]->BOOK_IMAGE;
            }

            $image1 = $_FILES['image1']['name'];
            if($image1 != "")
            {
                $this->UploadImage("image1");
            }
            else
            {
                $image1 =  $this->bookInfoByID[0]->BOOK_IMAGE_1;
            }
            $bookCost = $_POST["bookCost"];
            $bookOldCost = $_POST["bookOldCost"];

            $result = $this->adminModel->UpdateBookInfo($_POST["bookID"],$bookName,$description,$status,$category,$image,$image1,$bookCost,$bookOldCost);
            $status= "<style>.check{color:green;}</style>Chỉnh sửa thành công";
        }



        $data = array("status"=>$status,"bookInfoByID"=>$this->bookInfoByID);
        $view = array("update_book" => "update_book");
        $this->View($view,$data);
    }

    function DeleteBook()
    {
        $status = "";
        if(empty($_SESSION["userInfo"]))
        {
            header('Location: index.php?c=login');
            exit;
        }

        if($_SESSION["userInfo"][0]->POSITION != "admin")
        {
            header('Location: index.php?c=home');
            exit;
        }

        if(!empty($_POST["deleteBook"]))
        {
            $this->bookID = $_POST["bookID"];

            $this->bookInfoByID = $this->detailModel->GetBookDetailByID($this->bookID);

            if(!empty($this->bookInfoByID))
            {
                $deleteBook = $this->detailModel->DeleteBookByID($this->bookID);
                $status = "<style>label{color:green;}</style>Xóa sách thành công";
            }
            else
            {
                $status = "<style>label{color:red;}</style>Không tìm thấy sản phẩm yêu cầu";
            }

        }
        $data = array("status"=>$status);
        $view = array("delete_book" => "delete_book");
        $this->View($view,$data);
    }

    function UploadImage($image)
    {

        if(isset($_FILES[$image])){
            $errors= array();
            $file_name = $_FILES[$image]['name'];
            $file_size = $_FILES[$image]['size'];
            $file_tmp = $_FILES[$image]['tmp_name'];
            $file_type = $_FILES[$image]['type'];
            $file_ext=strtolower(end(explode('.',$_FILES[$image]['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152) {
                $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true) {
                move_uploaded_file($file_tmp,"public/themes/images/".$file_name);
            }else{
                print_r($errors);
            }
        }
    }
}
?>