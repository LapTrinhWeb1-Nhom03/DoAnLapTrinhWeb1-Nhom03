<?php
class Search extends Controller
{
    private $searchModel;
    private $search;
    private $listBook;
    private $currentPage = 1;
    private $totalOfPage;
    private $position = 0;
    function __construct()
    {
        //Khai báo model category
        include("application/models/searchs_model.php");

        $this->searchModel = new Searchs();
        $this->search =  empty($_GET["search"])? "1":$_GET["search"];
        $this->currentPage = empty($_GET["p"])? "1":$_GET["p"];
    }
    function Index()
    {
        if($this->currentPage > 1)
        {
            $this->position = $this->currentPage * 8 - 8;
        }

        $this->listBook = $this->searchModel->GetBookByName($this->position,8,$this->search);

        $this->totalOfPage = $this->searchModel->TotalOfPage($this->search);

        $data = array("listCategory"=>$this->listBook,"totalOfPage" =>$this->totalOfPage, "currentPage" => $this->currentPage, "search" => $this->search);
        $view = array("Index" => "Index","componentPagination"=>"pagination");
        $this->View($view,$data);
    }
}
?>