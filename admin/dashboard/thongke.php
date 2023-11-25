<?php
    session_start();
    require('../../carbon/autoload.php'); // sử dụng carbon để lấy ra thứ ngày tháng
    use Carbon\Carbon;
    include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");

?>
<style>
    .block{
        display: flex;
    }
    .col-md-3{
        margin-right: 80px;
    }
    h4{
        margin-top: 10px;
    }
</style>
<div class="container-fluid px-4"> 
    <div class="grid_10">
        <div class="box round first grid">
            <div class="card">
                <h4 align=center>Thống kê đơn hàng</h4>
                <form autocomplete="off">
                    <div class="card-body">
                        <div class="block" style="display:flex;">
                            <div class="col-md-3">
                                <p>Từ ngày : <input class="form-control date_from" type="text" id="datepicker_from"></p>
                                <input type="button" class="btn btn-success btn-locngay" value="Lọc kết quả"> 
                            </div>
                            <div class="col-md-3">
                                <p>Tới ngày : <input class="form-control date_to" type="text" id="datepicker_to"></p> 
                            </div>
                            <div class="col-md-3">
                                Lọc theo : <span id="text-date"></span>
                                <select class="form-control select-thongke" name="thoigian">
                                    <option>--Lọc theo---</option>
                                    <option value="7ngay">--Lọc theo 7 ngày---</option>
                                    <option value="30ngay">--Lọc theo 30 ngày---</option>
                                    <option value="90ngay">--Lọc theo 90 ngày---</option>
                                    <option value="365ngay">--Lọc theo 1 năm---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <h4 style="margin-left:80px;">Thống kê sản phẩm đơn hàng</h4>
                    <div id="donut-example" style="height: 250px;"></div>
                </div>
                <div class="col-md-4">
                    <h4 >Sản phẩm xem nhiều nhất</h4>
                    <style>
                        li{
                            margin-top: 5px;
                        }
                    </style>
                   
                    <ol class="list_views">
                        <?php
                            $sql = "select * from product order by ProdViewCount desc limit 10";
                            $result = mysqli_query($connection, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <li>
                                        <a target="_blank">
                                            <?=$row['ProdName']?> - <span style="color: black;"><?=$row['ProdViewCount']?> lượt xem</span>
                                        </a>
                                    </li>
                                <?php
                            }
                        ?>
                    </ol>
                </div>
                <div class="col-md-4">
                    <h4>Sản phẩm bán chạy nhất</h4>
                    <ol class="list_views">
                        <?php
                            $sql = "select ProdName, sum(OrdQuantity) as 'LuotMuaNhieuNhat' from product inner join orderdetail on product.ProdId = orderdetail.ProdId inner join orders on  orders.OrderId = orderdetail.OrderId where OrderStatus = 3 group by ProdName order by sum(OrdQuantity) desc limit 10";
                            $result = mysqli_query($connection, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <li>
                                        <a target="_blank">
                                            <?=$row['ProdName']?> - <span style="color: black;"><?=$row['LuotMuaNhieuNhat']?> đã bán </span>
                                        </a>
                                    </li>
                                <?php
                            }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include("../ajax/thongkesanpham.php");
    include_once('../includes/footer.php');
    
?>

