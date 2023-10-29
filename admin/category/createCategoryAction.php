<?php
session_start();
require_once('../../config/config.php');

      
        $Catename = $_POST['txtCatename'];
        $Catedesc = $_POST['taCatedesc'];
        if (isset($_FILES['txtCateimage']) && $_FILES['txtCateimage']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["txtCateimage"]["tmp_name"];
            $ext = pathinfo($_FILES["txtCateimage"]["name"], PATHINFO_EXTENSION);
            $Cateimage = uniqid() . '.' . $ext;
            move_uploaded_file($tmp_name, "../../images/" . $Cateimage);
            $sqlinsert = "insert into categories(CateName, CateDescription, CateImage) values('" . $Catename . "','" . $Catedesc . "','" . $Cateimage . "')";
            $connection->query($sqlinsert) or die($connection->connect_error);
            echo "Thêm danh mục thành công";
            header("Location: ./myCategory.php");
        }
    
