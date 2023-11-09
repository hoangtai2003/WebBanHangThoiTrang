<?php
    include_once('../../config/config.php');
    require('../../carbon/autoload.php'); // sử dụng carbon để lấy ra thứ ngày tháng
    use Carbon\Carbon;

    if(isset($_POST['thoigian'])){
        $thoigian = $_POST['thoigian'];
    } else {
        $thoigian = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }
    if($thoigian=='7ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString(); 
    }elseif($thoigian=='30ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
    }elseif($thoigian=='90ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
    }elseif($thoigian=='365ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    if (isset($_POST['from_date']) && $_POST['from_to']){
        $from = $_POST['from_date'];
        $to= $_POST['from_to'];
        $sql = "select DATE(created_at) as 'ngay', count(OrderId) as 'TongDonHang', Sum(OrderTotalPrice) as 'TongTien', sum(OrderQuantity) as 'TongSanPhamDaBan' from orders where created_at between '$from' and '$to' group by ngay order by created_at asc ";
    } else {
        $sql = "select DATE(created_at) as 'ngay', count(OrderId) as 'TongDonHang', Sum(OrderTotalPrice) as 'TongTien', sum(OrderQuantity) as 'TongSanPhamDaBan' from orders where created_at between '$subdays' and '$now' group by ngay order by created_at asc";
    }
    $result = mysqli_query($connection, $sql);
    foreach($result as $key => $row){
        $chart_data[] = array(
            'date' => $row['ngay'],
            'order' => $row['TongDonHang'],
            'revenue' => $row['TongTien'],
            'quantity' => $row['TongSanPhamDaBan'],
        );
    }
    echo $data = json_encode($chart_data);
?>