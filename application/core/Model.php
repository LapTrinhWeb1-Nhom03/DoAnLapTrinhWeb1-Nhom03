<?php
    require("application/core/Database.php");
    Class Model
    {
        public $db;
        public $className;

        function __construct()
        {
            $this->db = new Database();
            $this->className = get_class($this);
        }

        function SelectAll()
        {
            //Câu Select
            $sql = "SELECT * FROM ".$this->className;

            //Thực thi câu lệnh
            $runSql = $this->db->QueryResult($sql);

            //Trả về dữ liệu
            return $runSql->fetchAll(PDO::FETCH_CLASS);
        }

        function GetById($id)
        {

            //Câu Select
            $sql = "SELECT * FROM ".$this->className." WHERE ID = $id";

            //Thực thi câu lệnh
            $runSql = $this->db->QueryResult($sql);

            //Trả về dữ liệu
            return $runSql->fetchObject();
        }

        function  Update($obj)
        {

        }

        function Delete($id)
        {


            $sql = "DELETE FROM ".$this->className."WHERE ID = $id";
            $count = $this->db->ExeQuery($sql);
            return $count;
        }
    }

?>