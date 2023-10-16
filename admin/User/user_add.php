<?php
session_start();

    include('../../config/config.php');
    include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php')
?>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">User</li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <div class="row">
        <?php include('../authen/message.php'); ?>
            <div class="col-md-6">
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
                                <input required type="text" name="name" class="form-control" value=>  
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input required type="email" class="form-control" name="email" value=>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input required type="password" class="form-control" name="password">
                            </div>
                            <button name="add_user" type="submit" class="btn btn-primary mt-2">Submit</button>
                            <a href="user_list.php" class="btn btn-danger mt-2">Back</a>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('../includes/footer.php');
?>
    

