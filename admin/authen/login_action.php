<?php
    session_start();
    include('../../config/config.php');
    if(isset($_POST['login_btn'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $sql = "Select * from users where UserName = '$name' and UserPassword = '$password_hash'  LIMIT 1";
        $result =mysqli_query($connection,$sql) or die ($connection->error);
        if ($row = mysqli_fetch_assoc($result)){
            $_SESSION['loggedin'] = true;//đăng nhập thành công
            $_SESSION['username'] = $name;
            $user = $row;
            $query = "SELECT * FROM role_user INNER JOIN role on role_user.role_id = role.id where role_user.user_id =" .$user['UserId'];
            $query_run = mysqli_query($connection, $query);
            $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            if (!empty($result)){
                $user['privileges'] = array();
                foreach($result as $role){
                    $user['privileges'][] = $role['url_match'];
                }
            };
            $_SESSION["current_user"] = $user;
            header('Location: ../home/index.php');
            exit(0);
        }else {
            $_SESSION['message'] = "Email hoặc Password không hợp lệ";
            header('Location: login.php');
            exit(0);
        }
        $connection->close();
    } else {
        header('Location: login.php');
        exit(0);
    }


?>