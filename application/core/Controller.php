<?php
    class Controller
    {
        function  View($viewName,$data=null,$useLayout=true)
        {
            //Kiểm tra biến $data có dữ liệu không
            if($data != null)
            {
                foreach($data as $key => $value)
                {
                    $$key = $value;
                }
            }
            //Giải phóng biến Data
            unset($data);
			
            //Tạo biến toàn cục
            global $app_path,$controller_path,$view_path;

            //lấy tên class tương ứng với tên control
            $controller_Name = strtolower(get_class($this));
			
            if($useLayout)
            {
                //Gọi header nếu layout = true
                require("$app_path/$view_path/shared/header.php");
            }


            if($viewName != null)
            {
                foreach($viewName as $key => $value)
                {
                    if(strpos($key,"component") !== false)
                    {
                        require("$app_path/$view_path/shared/".strtolower($value).".php");
                    }
                    else
                    {
                        require("$app_path/$view_path/$controller_Name/".strtolower($value).".html");
                    }
                }
            }

            if($useLayout)
            {
                //G?i footer n?u s? d?ng layout = true
                require("$app_path/$view_path/shared/footer.php");
            }
        }
    }
?>