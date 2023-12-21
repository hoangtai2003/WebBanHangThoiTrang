<?php
session_start();
require_once('../../config/config.php');
$CusId = $_SESSION["cusid"]; //id sender (me)
$UserId = $_SESSION["UserId"]; //id receiver
echo $_POST['textmessage'];
if ($_POST['textmessage'] != '') {
    $message_content = $_POST['textmessage'];
    $sqlSendMessage = "Insert into messages(UserId, CusId, WriteId, message) values ('$UserId', '$CusId', '$CusId', '$message_content')";
    $result = mysqli_query($connection, $sqlSendMessage);
    if ($result) {
        header("Location:  ../index/index.php");
        exit;
    } else {
        echo "Lỗi khi gửi tin nhắn";
    }
} else {
    header("Location:  ../index/index.php");
    exit;
}
?>