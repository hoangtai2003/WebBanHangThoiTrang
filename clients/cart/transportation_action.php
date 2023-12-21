<?php
// thay đổi thông tin vận chuyển
session_start();
require("../../config/config.php");
if (isset($_POST['cmdTransportation'])) {
    $name = $_POST['txtname'];
    $phone = $_POST['txtphone'];
    $address = $_POST['txtaddress'];
    $note = $_POST['txtnote'];
    $cusid = $_SESSION['cusid'];
    $sql_insert_trans = "INSERT INTO ship (ShipName, ShipPhone, ShipAddress, ShipNote, CusId) VALUES ('" . $name . "', '" . $phone . "', '" . $address . "', '" . $note . "', '" . $cusid . "')";
    $result_insert_trans = $connection->query($sql_insert_trans);
    header("Location: ./transportation_view.php");
}
?>