<?php
session_start();
include('../../config/config.php');
$target_dir = "../upload/";
$uploadOk = true;

if (isset($_POST['update_slider'])) {
    $slider_id = $_POST['slider_id'];
    $name = $_POST['name'];
    $description = $_POST['sldescription'];
    
    // $current_image = $slider['slimage']; // Hình ảnh hiện tại

    // Kiểm tra xem người dùng đã tải lên hình ảnh mới chưa
    if (isset($_FILES['fimage']) && !empty($_FILES['fimage']['name'])) {
        $file_name = $_FILES['fimage']['name'];
        $file_path = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES['fimage']['tmp_name'], $file_path)) {
            // Cập nhật cơ sở dữ liệu với tên tệp mới
            $sql = "UPDATE sliders SET slname = '$name', sldescription = '$description', slimage = '$file_name' WHERE slid = '$slider_id'";
            $result = mysqli_query($connection, $sql) or die($connection->error);
            if ($result) {
                $_SESSION['message'] = "Cập nhật thành công";
                header('Location: slider_list.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Đã xảy ra sự cố";
                header('Location: slider_list.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Không thể tải lên tệp hình ảnh mới.";
            $uploadOk = false;
            header("Location: slider_list.php");
        }
    } else {
        // Nếu không có hình ảnh mới, chỉ cập nhật tên và mô tả
        $sql = "UPDATE sliders SET slname = '$name', sldescription = '$description' WHERE slid = '$slider_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);
        $connection->close();
        if ($result) {
            $_SESSION['message'] = "Cập nhật thành công";
            header('Location: slider_list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            header('Location: slider_list.php');
            exit(0);
        }
    }
}
?>