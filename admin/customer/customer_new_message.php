<?php
session_start();
include("../connMySQL.php");
$CusId = $_REQUEST["CusId"]; //id receiver
$UserId = $_SESSION["UserId"]; //id sender (me)



// $sql_chat_data = $pdo->prepare("Select my.id_user as my_id, my.username as my_username,my.avt_user as my_avatar, message, pos.id_user as pos_id, pos.username as pos_username, pos.avt_user as pos_avatar
//                             From messages m
//                             inner join users_acc as my on my.id_user = m.sender_id 
//                             inner join users_acc as pos on pos.id_user = m.receiver_id
//                             where ((m.sender_id = $my_userID and m.receiver_id=$ReceverID) 
//                             or (m.sender_id=$ReceverID and m.receiver_id=$my_userID)) 
//                             and (m.receiver_id != m.sender_id)
//                             order by m.message_id DESC
// ");
// $sql_chat_data->execute();
// $chat_data = $sql_chat_data->fetchAll(PDO::FETCH_ASSOC);

// Trả về dữ liệu dưới dạng JSON
echo json_encode($chat_data);
?>
