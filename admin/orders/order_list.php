<?php
session_start();
    include('../../config/config.php');
    include('../includes/header.php'); 
?>
 <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>
                   <script>
                    $(document).ready(function(){
                   $('.orderSearch').on('input',function(){
                    var inputValue= $('.orderSearch').val();
                    var currentUrl = window.location.href;
                    var orderListUrl = currentUrl.substring(0, currentUrl.lastIndexOf('/') + 1) + 'order_list.php';
                    

                        $.get(orderListUrl ,{data: inputValue}, function(data){
                            var limitedContent = $(data).find('.highlight');
                                $("#order_table").html(limitedContent);
                        });
                    
                    
                   });
                });
                    </script>
    <div class="container-fluid px-4">
        <div class=" float-end">
                        <form action="" method="Post">
                        <input class="form-control orderSearch" id=""  type="text" required style="margin-left:0;"  placeholder="Tìm kiếm..."  />
                        </form>
        </div>
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Đơn hàng</li>
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
        </ol>
        <div id="order_table" class="Prod highlight">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Danh sách đơn hàng</h4>
                    </div>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] === "GET") {
                
                            // Xử lý Ajax request
                            $search = isset($_GET["data"]) ? $_GET["data"] : '';
                ?>
                    <div class="card-body highlight">
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
                                    <?php if (checkPrivilege('order_detail.php?orderid=0')) { ?>
                                    <th scope="col">Thông tin</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include("../pagination/offset.php");
                                    $sql = "SELECT * FROM orders, customer
                                     WHERE orders.CusId = customer.CusId and customer.CusName like '%".$search."%'
                                     ORDER BY orders.OrderId desc 
                                     limit ".$item_per_page." offset ".$offset."";
                                    $result = mysqli_query($connection,$sql);
                                    $totalRecords = mysqli_query($connection, "select * from orders");
                                    $totalRecords = $totalRecords->num_rows;
                                    // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                                    $totalPage = ceil($totalRecords / $item_per_page);
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
                                                    <?php if (checkPrivilege('order_detail.php?orderid=0')) { ?>
                                                    <td>
                                                        <a 
                                                            href="./order_detail.php?orderid=<?php echo $row['OrderId'] ?>" 
                                                            class="btn btn-sm btn-success">Xem chi tiết
                                                        </a>
                                                    </td> 
                                                    <?php }?>
                                                </tr>
                                            <?php
                                        }
                                    }}
                                    $connection->close();
                                ?>
                            </tbody>
                        </table>
                    <?php include("../pagination/pagination.php") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('../includes/footer.php');
?>