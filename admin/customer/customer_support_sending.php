<?php
session_start();
require_once('../../config/config.php');
echo "đang gửi"
// $ReceverID = $_REQUEST["userID"]; //id receiver
// $My_id = $_SESSION["id_user"]; //id sender (me)


// if ($_POST['textmessage'] != '') {
//     $message_content = $_POST['textmessage'];
//     $sqlSendMessage = $pdo->prepare("INSERT INTO messages (room_id, sender_id, receiver_id, message)
//                                     SELECT COALESCE((SELECT room_id FROM messages WHERE (sender_id = '$My_id' AND receiver_id = '$ReceverID') OR (sender_id = '$ReceverID' AND receiver_id = '$My_id') LIMIT 1),
//                                     (SELECT MAX(COALESCE(room_id, 0)) + 1 FROM messages)), '$My_id', '$ReceverID', '$message_content'");
//     if ($sqlSendMessage->execute()) {
//         header("Location:  ./Inbox.php?userID=" . $ReceverID);
//         exit;
//     } else {
//         echo "Lỗi khi gửi tin nhắn";
//         var_dump($sqlSendMessage->errorInfo());
//     }
// } else {
//     header("Location:  ./Inbox.php?userID=" . $ReceverID);
//     exit;
// }
?>