<?php
    class Category extends Controller
    {

        //Biến chứa mã category
        private $categoryID;

        //Biến chứa tên category
        private $nameCategory;

        //Biến chứa model category
        private $categoryModel;

        //Trang hiện đại
        private $currentPage = 1;

        //Tổng số trang
        private $totalOfPage;

        //Dach sách book
        private $listBook;


        //Vị trí đang đứng
        private $position = 0;

        function __construct()
        {
            //Khai báo model category
            include("application/models/categories_model.php");

            $this->categoryModel = new Categories();

            //Lấy và gán dữ liệu Mã ID category và vị trí đang được vào 2 biến đã tạo sẵn ở trên
            $this->categoryID = empty($_GET["ct"])? "1":$_GET["ct"];
            $this->currentPage = empty($_GET["p"])? "1":$_GET["p"];
        }
        function Index()
        {
            if($this->currentPage > 1)
            {
                $this->position = $this->currentPage * 8 - 8;
            }

            //Lấy danh sách book với mã category và vị trí được truyền vào
            $this->listBook = $this->categoryModel->SelectBookByCategory($this->position,8,$this->categoryID);

            //Lấy tên category bằng category ID
            $this->nameCategory = $this->categoryModel->GetNameCategoryByID($this->categoryID);

            //Đếm tổng số sách theo category ID
            $this->totalOfPage = $this->categoryModel->TotalOfPage($this->categoryID);

            //Biến dữ liệu dùng để truyền qua View
            $data = array("listCategory"=>$this->listBook,"nameCategory"=>$this->nameCategory, "totalOfPage" =>$this->totalOfPage, "currentPage" => $this->currentPage, "categoryID"=>$this->categoryID);

            //Khởi tạo view và phân trang
            $view = array("Index" => "Index","componentPagination"=>"pagination");

            //Khởi động view với biến data truyền vào
            $this->View($view,$data);
        }
    }
?>