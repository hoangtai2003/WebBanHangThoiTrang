<?php
    require_once('../../config/config.php');
    $CateId = $_REQUEST['CateId'];
    $Catename = $_POST["txtCateName"];
    $Catedesc = $_POST['taCatedesc'];
    
    if (isset($_FILES['txtCateimage']) && $_FILES['txtCateimage']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["txtCateimage"]["tmp_name"];
        $ext = pathinfo($_FILES["txtCateimage"]["name"], PATHINFO_EXTENSION);
        $Cateimage = uniqid() . '.' . $ext;
        move_uploaded_file($tmp_name, "../../images/" . $Cateimage);
    }
        $sql = "select * from categories where CateName like '$Catename' and CateId<>$CateId";
        $result = $connection->query($sql);
    
    if ($result->num_rows>0){
      
        header("Location:./editCategory.php");
        } else {
                $sql ="update categories set
                     CateName='$Catename',
                     
                    CateDescription='$Catedesc'
                where CateId=$CateId";
                
                $connection->query($sql) or die($connection->error);
                $connection->close();
                
                    
                    header("Location:./myCategory.php");
                
        }
    
   
    
?>