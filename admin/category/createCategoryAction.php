<?php
    session_start();
    include('../../config/config.php');
    $target_dir = "../upload/";
    $uploadOk = true;
    if (isset($_POST['add_category'])){
        $Catename = $_POST['txtCatename'];
        $Catedescription = $_POST['taCatedesc'];
        $status = $_POST['rdstatus'];
        $file_path = $target_dir.$_FILES['fimage']['name'];
        $file_name = $_FILES['fimage']['name'];

        // Kiểm tra file ảnh là thật hay giả
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fimage"]["tmp_name"]);
            if($check !== false) {
                $_SESSION['message'] = "File là một hình ảnh - " . $check["mime"] . ".";
                $_SESSION['message_type'] = 'warning';
                $uploadOk = true;
            } else {
                $_SESSION['message'] = "File không phải là hình ảnh.";
                $_SESSION['message_type'] = 'error';
                $uploadOk = false;
            }
        }
        // Kiểm tra file có đúng định dạng hay không
        // strtolower chuyển tất cả các ký tự trong chuỗi thành chữ thường
        // pathinfo trả về thông tin về đường dẫn file
        $ex = array('jpg', 'png', 'jpeg');
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        if (!in_array($file_type, $ex)){
            $_SESSION['message'] ="Loại file không hợp lệ";
            $_SESSION['message_type'] = 'error';
            $uploadOk = false;
            header("location: createCategory.php");
        }
        // Kiểm tra dung lượng của file
        if ($_FILES['fimage']['size'] > 500000){
            echo "Dung lượng file quá lớn";
            $_SESSION['message_type'] = 'warning';
            $uploadOk = false;
            header("location: createCategory.php");
        }
        if ($uploadOk) {
            if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
                $sql = "INSERT INTO categories (CateName, CateDescription, CateImage, CateStatus) VALUES ('$Catename', '$Catedescription', '$file_name', '$status')";
                $result = mysqli_query($connection, $sql);
    
                if ($result) {
                    $_SESSION['message'] = 'Thêm danh mục sản phẩm thành công';
                    $_SESSION['message_type'] = 'success';
                    header('Location: myCategory.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = 'Đã xảy ra sự cố';
                    $_SESSION['message_type'] = 'error';
                    header('Location: myCategory.php');
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Không upload được";
                $_SESSION['message_type'] = 'error';
                header("location: createCategory.php"); 
            }
        }
    }
?>