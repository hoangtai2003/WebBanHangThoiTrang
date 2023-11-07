<?php
    $servername = "localhost";
    $username = "root";
    $password = "MyNewPass";
    $dbname = "webbanhangthoitrang";
    $connection = new mysqli($servername,$username,$password,$dbname);
    //hàm kiểm tra xem kết nối có đúng không:
    if ($connection->connect_error){
        die("Couldn't connect to the database".$connection->connect_error);
    } else {
        // echo "Kết nối thành công!";
    }
?>




