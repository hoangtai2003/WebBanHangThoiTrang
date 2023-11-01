<?php
session_start();
require("../../config/config.php");

if (isset($_POST['cmd_add'])) {
    $name = $_POST['txtname'];
    $phone = $_POST['txtphone'];
    $address = $_POST['txtaddress'];
    $note = $_POST['txtnote'];
    $cusid = $_SESSION['cusid'];
    $sql_insert_trans = "INSERT INTO ship (ShipName, ShipPhone, ShipAddress, ShipNote, CusId) VALUES ('" . $name . "', '" . $phone . "', '" . $address . "', '" . $note . "', '" . $cusid . "')";
    $result_insert_trans = $connection->query($sql_insert_trans);
    if ($result_insert_trans) {
        $_SESSION['message'] = "Thêm thông tin vận chuyển thành công";
        header("Location: ./transportation_view.php");
        exit();
    }
}
?>

