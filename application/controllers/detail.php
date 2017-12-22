<?php
    class Detail extends Controller
    {
        private $detailModel;
        private $bookID;
        private $bookDetail;
        private $bookSameType;
        private $bookModel;
        private $hot;


        function __construct()
        {
            //Khai báo model category
            include("application/models/detail_model.php");
            include("application/models/books_model.php");

            $this->bookModel = new Books();
            $this->detailModel = new Details();
            $this->bookID = empty($_GET["id"])? "1":$_GET["id"];
        }

        function Index()
        {

            $this->hot = $this->bookModel->SelectHotBooks(0,3);

            $this->bookDetail = $this->detailModel->GetBookDetailByID($this->bookID);

            $this->bookSameType = $this->detailModel->GetBookSameType($this->bookDetail[0]->CATEGORY_ID,0,3);

            $data = array("bookDetail"=>$this->bookDetail,"bookSameType" => $this->bookSameType, "hot"=> $this->hot);

            $view = array("Index" => "Index");
            $this->View($view,$data);
        }
    }
?>