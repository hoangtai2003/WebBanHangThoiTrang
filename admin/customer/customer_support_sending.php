<?php
session_start();
require_once('../../config/config.php');
echo "đang gửi";
$UserId = $_SESSION["UserId"]; //id sender (me)
$CusId = $_REQUEST["CusId"]; //id receiver

if ($_POST['textmessage'] != '') {
    $message_content = $_POST['textmessage'];
   
    $sqlSendMessage = "Insert into messages(UserId, CusId, WriteId, message) values ('$UserId', '$CusId', '$UserId', '$message_content')";
    $result = mysqli_query($connection, $sqlSendMessage);
    if ($result) {
        header("Location:  ./customer_support.php?CusId=" . $CusId);
        exit;
    } else {
        echo "Lỗi khi gửi tin nhắn";
    }
} else {
    header("Location:  ./customer_support.php?CusId=" . $CusId);
    exit;
}
?>