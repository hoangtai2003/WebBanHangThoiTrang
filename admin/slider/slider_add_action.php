<?php
    session_start();
    include('../../config/config.php');
    $target_dir = "../upload/";
    $uploadOk = true;
    if (isset($_POST['add_slider'])){
        $name = $_POST['name'];
        $description = $_POST['sldescription'];

        $file_path = $target_dir.$_FILES['fimage']['name'];
        $file_name = $_FILES['fimage']['name'];

        // Kiểm tra file ảnh là thật hay giả
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fimage"]["tmp_name"]);
            if($check !== false) {
                $_SESSION['message'] = "File là một hình ảnh - " . $check["mime"] . ".";
                $uploadOk = true;
            } else {
                $_SESSION['message'] = "File không phải là hình ảnh.";
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
            $uploadOk = false;
            header("location: slider_add.php");
        }
        // Kiểm tra dung lượng của file
        if ($_FILES['fimage']['size'] > 500000){
            echo "Dung lượng file quá lớn";
            $uploadOk = false;
            header("location: slider_add.php");
        }
        if ($uploadOk) {
            if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
                $sql = "INSERT INTO sliders (slname, sldescription, slimage) VALUES ('$name', '$description', '$file_name')";
                $result = mysqli_query($connection, $sql);
    
                if ($result) {
                    $_SESSION['message'] = 'Thêm slider thành công';
                    header('Location: slider_list.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = 'Đã xảy ra sự cố';
                    header('Location: slider_list.php');
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Không upload được";
                header("location: slider_add.php"); 
            }
        }
    }
?>