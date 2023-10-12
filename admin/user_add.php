<?php
session_start();

    include('../config/config.php');
    include('includes/header.php'); 
    include_once('includes/navbar_top.php');
    include_once('includes/sidebar.php')
?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add User</h4>
                            </div>
                            <div class="card-body">
                                <form action="user_add_action.php" method="POST">
                                    <div class="form-group">
                                        <input hidden type="text" name="user_id" class="form-control" value=>  
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value=>  
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value=>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <button name="add_user" type="submit" class="btn btn-primary mt-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include('includes/footer.php');
?>
    

