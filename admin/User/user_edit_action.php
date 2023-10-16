<?php
    session_start();
    include('../../config/config.php');
    if (isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = test_input($_POST['email']);
        $status = $_POST['rdstatus'];
        if (strpos($name, ' ') !== false || strpos($email, ' ')){
            $_SESSION['message'] = "Ký tự nhập vào không được chứa khoảng trắng!";
            header("Location: user_edit.php?UserId=$user_id");
        }
        else{
            $sql = "SELECT UserName, UserEmail from users where  (UserEmail = '$email' or UserName ='$name') and UserId != '$user_id'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Already Username or Email Exists";
                header("Location: user_edit.php?UserId=$user_id");
            } 
            else{
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $sql = "Update users set UserName = '$name', UserEmail = '$email', UserStatus = '$status' where UserId = '$user_id'";
                    $result = mysqli_query($connection, $sql) or die($connection->error);
                    $connection->close();
                    if ($result){
                        $_SESSION['message'] = "Updated Successfully";
                        header('Location: user_list.php');
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Something went wrong";
                        header('Location: user_list.php');
                        exit(0);
                    }
                }
                else{
                    $_SESSION['message'] = "Email is Invalid";
                    header("Location: user_edit.php?UserId=$user_id");
                    exit(0);
                }
            }
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>