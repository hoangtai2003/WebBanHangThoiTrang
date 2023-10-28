<?php
session_start();
    include('../../config/config.php');
    include('../includes/header.php'); 
?>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Đơn hàng</li>
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
        </ol>
        <div class="row">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Danh sách đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Phương thức thanh toán</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Thông tin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM orders, customer WHERE orders.CusId = customer.CusId ORDER BY orders.OrderId DESC";
                                    $result = mysqli_query($connection,$sql);
                                    if (mysqli_fetch_array($result) > 0){
                                        foreach($result as $row){
                                            ?>
                                                <tr class="text-center">
                                                    <th scope="row"><?=$row['OrderId'];?></th>
                                                    <td><?=$row['OrderCode'];?></td>
                                                    <td><?=number_format($row['OrderTotalPrice'], 0, ',', '.');?></td>
                                                    <td><?=$row['CusName'];?></td>
                                                    <td><?=$row['CusPhone'];?></td>
                                                    <td>
                                                        <?php
                                                            if($row['OrderPayment'] == 'tienmat'){
                                                                echo "Thanh toán khi nhận hàng";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                            if($row['OrderStatus']==0){
                                                                echo '<a href="./order_action.php?action=xacnhan&orderid='.$row['OrderId'].'" class="btn btn-sm btn-primary">Xác nhận</a>';
                                                            } else if ($row['OrderStatus']== 1){
                                                                echo '<a href="./order_action.php?action=vanchuyen&orderid='.$row['OrderId'].'" class="btn btn-sm btn-primary">Gửi hàng</a>';
                                                            } else if ($row['OrderStatus']== 2){
                                                                echo 'Đang giao';
                                                            }
                                                            else if ($row['OrderStatus']==3){
                                                                echo "Đã hoàn thành";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><a href="./order_detail.php?orderid=<?php echo $row['OrderId'] ?>" class="btn btn-sm btn-success">Xem chi tiết</a></td>
                                                    
                                                </tr>
                                            <?php
                                        }
                                    }
                                    $connection->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('../includes/footer.php');
?>