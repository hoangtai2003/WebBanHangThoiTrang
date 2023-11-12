                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
        <script src="../assets/js/sweetalert2.all.min.js"></script>
        <script src="../assets/js/jquery-3.7.1.min.js"></script>
        <script src="../assets/js/delete_alert.js"></script>
        <script src="../assets/js/show_image.js"></script>
        <script src="../assets/js/checkbox.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script type="text/javascript" src="../assets/js/thongke.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="../assets/js/date.js"></script>
        <script src="../assets/js/thongkedonhang.js"></script>
        <script>
            $(document).ready(function(){
                var colorDanger = "#FF1744";
                var donut = Morris.Donut({
                    element: 'donut-example',
                    resize: true,
                    colors: [
                        '#f58742',
                        '#f5429e',
                        '#42f5c8',
                    ],
                    data: [
                        {label:"Tổng số sản phẩm", value: <?php echo $totalProduct?>},
                        {label:"Tổng số khách hàng", value: <?php echo $totalCustomers?>},
                        {label:"Tổng số đơn hàng", value: <?php echo $totalOrders?>}
                    ]
                });
            });
        </script>
    </body>
</html>