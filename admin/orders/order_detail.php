<?php
session_start();
    include('../../config/config.php');
    $orderid = $_GET['orderid'];
    $sql1 = "SELECT * FROM orders WHERE OrderId = '".$orderid."'";
    $result1 = $connection->query($sql1);
    if($result1->num_rows == 0){
        $_SESSION['message'] = "Đơn hàng không tồn tại!";
        header("Location: ./order_list.php");
        exit;
    }
    include('../includes/header.php'); 
    
?>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Đơn hàng</li>
            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Chi tiết đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM orders, orderdetail, product WHERE orders.OrderId = orderdetail.OrderId AND orderdetail.ProdId = product.ProdId AND orderdetail.OrderId = '".$orderid."'";
                                    $result = mysqli_query($connection,$sql);
                                    if (mysqli_fetch_array($result) > 0){
                                        $tongtien = 0;
                                        foreach($result as $row){
                                            $thanhtien = $row['OrdQuantity']*$row['OrdPrice'];
                                            $tongtien += $thanhtien;
                                            ?>
                                                <tr class="text-center">
                                                    <th scope="row"><?=$row['OrderId'];?></th>
                                                    <td><?=$row['OrderCode'];?></td>
                                                    <td><?=$row['ProdName'];?></td>
                                                    <td><img src="../../images/<?php echo $row['ProdImage']?>" width="60"></td>
                                                    <td><?=number_format($row['OrdPrice'], 0, ',', '.');?></td>
                                                    <td><?=$row['OrdQuantity'];?></td>
                                                    <td><?=number_format($thanhtien, 0, ',', '.')?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                                
                            </tbody>
                            <tr>
                                    <th colspan="6" style="text-align: right;">Tổng tiền:</th>
                                    <th class="text-center"><?php echo number_format($tongtien, 0, ',', '.') ?></th>
                                </tr>
                        </table>

                        <?php
                            $sql2 = "SELECT * FROM Orders WHERE OrderId = '".$orderid."'";
                            $result2 = $connection->query($sql2);
                            $row2 = $result2->fetch_assoc();

                            $sql3 = "SELECT * FROM ship WHERE ShipId = '".$row2['ShipId']."'";
                            $result3 = $connection->query($sql3);
                            if($result3->num_rows > 0){
                                $row3 = $result3->fetch_assoc();
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã ship</label>
                                    <p class="form-control"><?php echo $row3['ShipId'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên người nhận</label>
                                    <p class="form-control"><?php echo $row3['ShipName'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số điện thoại người nhận</label>
                                    <p class="form-control"><?php echo $row3['ShipPhone'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Địa chỉ nhận</label>
                                    <p class="form-control"><?php echo $row3['ShipAddress'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <p class="form-control"><?php echo $row3['ShipNote'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                        <a href="./order_list.php" class="btn btn-sm btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('../includes/footer.php');
?>