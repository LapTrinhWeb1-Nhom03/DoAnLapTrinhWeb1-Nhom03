<?php
    class Database
    {
        private $db;
        function __construct()
        {
            //Lấy biến toàn cục được tạo từ file bootstap
            global $host,$dbName,$user,$pass;
            $this->db = new PDO("mysql:host=$host;dbname=$dbName;charset=UTF8","$user","$pass");

        }

        //Hàm dùng để thực thi câu lệnh để lấy dữ liệu
        function QueryResult($sql)
        {
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query;
        }

        //Hàm dùng để thực thi câu lệnh như update,....
        function ExeQuery($sql)
        {
            $query = $this->db->exec($sql);
            return $query;
        }
    }
