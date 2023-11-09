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
            <!-- <h4 align=center>Thống kê truy cập</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Đang online</th>
                        <th scope="col">Tổng tháng trước</th>
                        <th scope="col">Tổng tháng này</th>
                        <th scope="col">Tổng 1 năm</th>
                        <th scope="col">Tổng truy cập</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>.</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
</div>
<?php 
    include_once('../includes/footer.php');
    
?>

