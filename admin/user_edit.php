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
                                <h4>Edit User</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_GET['UserId'])){
                                        $user_id = $_GET['UserId'];
                                        $sql = "Select * from users where UserId = '$user_id'";
                                        $result = mysqli_query($connection, $sql);
                                        if (mysqli_fetch_array($result) > 0){
                                            foreach($result as $user){
                                                ?>
                                                    <form action="user_edit_action.php" method="POST">
                                                        <div class="form-group">
                                                            <input hidden type="text" name="user_id" class="form-control" value=<?= $user['UserId'] ?>>  
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="name" class="form-control" value=<?= $user['UserName'] ?>>  
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="email" value=<?= $user['UserEmail'] ?>>
                                                        </div>
                                                        <button name="update_user" type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </form>
                                                <?php
                                            }
                                        }
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include('includes/footer.php');
?>
    

