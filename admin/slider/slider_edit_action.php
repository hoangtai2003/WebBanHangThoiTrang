<?php
session_start();
include('../../config/config.php');
$target_dir = "../upload/";
$uploadOk = true;
if (isset($_POST['update_slider'])) {
    $slider_id = $_POST['slider_id'];
    $name = $_POST['name'];
    $description = $_POST['sldescription'];
    if (!empty($_FILES['fimage']['name'])) {
        $new_file_name = $_FILES['fimage']['name'];
        $new_file_path = $target_dir . $new_file_name;
    }
    if ($uploadOk) {
        if (move_uploaded_file($_FILES['fimage']['tmp_name'], $new_file_path)) {
            $sql = "UPDATE sliders SET slname = '$name', sldescription = '$description', slimage = '$new_file_name' WHERE slid = '$slider_id'";
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
        else {
            $_SESSION['message'] = "Không thể tải lên tệp hình ảnh mới.";
            $uploadOk = false;
        } 
    }
}
?>
