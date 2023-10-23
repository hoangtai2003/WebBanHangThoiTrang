<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_customer'])){
        $cus_id = $_POST['CusId'];
        $name = $_POST['CusName'];
        $code = $_POST['CusCode'];
        $phone = $_POST['CusPhone'];
        $email = $_POST['CusEmail'];
        $address = $_POST['CusAddress'];
        $birthday = $_POST['CusBirthday'];
        $gender = $_POST['rdGender'];
        $sql = "SELECT CusName, CusEmail from customers where  (CusEmail = '$email' or CusName ='$name') and CusId != '$cus_id'";
        $result = mysqli_query($connection,$sql) or die ($connection->error);
        if (mysqli_num_rows($result) > 0){
            $_SESSION['message'] = "Email hoặc tên đã tồn tại";
            header("Location: customer_edit.php?CusId=$cus_id");
        } 
        else{
            $sql = "Update customers set CusName = '$name',CusCode = '$code', CusPhone = '$phone', CusEmail = '$email',CusAddress = '$address', CusBirthday = '$birthday',  CusGender = '$gender' where CusId = '$cus_id'";
            $result = mysqli_query($connection, $sql) or die($connection->error);
            $connection->close();
            if ($result){
                $_SESSION['message'] = "Cập nhật thành công";
                header('Location: customer_list.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Đã xảy ra sự cố";
                header('Location: customer_list.php');
                exit(0);
            }
        }
    }
?>
