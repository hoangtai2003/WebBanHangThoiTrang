<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['add_slider'])){
        $name = $_POST['name'];
        $description = $_POST['sldescription'];
        $image = $_POST['fimage'];
        $sql = "Insert into sliders(slname, sldescription, slimage) values ('$name', '$description', '$image')";
        $result = mysqli_query($connection, $sql);
        $connection->close();
        if ($result){
            $_SESSION['message'] = 'Thêm slider thành công';
            header('Location: slider_list.php');
            exit(0);
        }else {
            $_SESSION['message'] = 'Đã xảy ra sự cố';
            header('Location: slider_list.php');
            exit(0);
        }
    }
?>