<?php
session_start();
include('../../config/config.php');
if (isset($_POST['update_customer'])){
    $cus_id = $_POST['CusId'];
    $name = $_POST['CusName'];
    $phone = $_POST['CusPhone'];
    $email = $_POST['CusEmail'];
    $birthday = $_POST['CusBirthday'];
    $gender = $_POST['CusGender'];
    $sql = "SELECT CusEmail from customer where  (CusEmail = '$email') and CusId != '$cus_id'";
    $result = mysqli_query($connection,$sql) or die ($connection->error);
    if (mysqli_num_rows($result) > 0){
        $_SESSION['message'] = "Email đã tồn tại";
        header("Location: profile.php");
    } 
    else{
        $sql = "Update customer set CusName = '$name', CusPhone = '$phone', CusEmail = '$email', CusBirthday = '$birthday',  CusGender = '$gender' where CusId = '$cus_id'";
        $result = mysqli_query($connection, $sql) or die($connection->error);
        $connection->close();
        if ($result){
            $_SESSION['message'] = "Cập nhật thành công";
            header('Location: profile.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Đã xảy ra sự cố";
            header('Location: profile.php');
            exit(0);
        }
    }
}
?>
?>