<?php
    class Home extends  Controller
    {
        function __construct()
        {

        }
        function Index()
        {
            include("application/models/books_model.php");
            $books = new Books();
            //Biến chứa dữ liệu component sách mới
            $new = $books->SelectNewBooks(0,8);
			
            $hot = $books->SelectHotBooks(0,8);

            $banner = $books->SelectBannerBooks(0,5);

            //Biến dữ liệu dùng để truyền qua View
            $data = array("new"=>$new, "hot"=>$hot, "banner" => $banner);

            //Biến chứa danh sách component + view
            $view = array("componentBanner" => "banner","Index" => "Index","componentMp3"=>"mp3");

            //Khởi động view với các biến truyền vào
            $this->View($view,$data);
        }

    }
?>