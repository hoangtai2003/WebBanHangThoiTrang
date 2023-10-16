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
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
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
                                $connection->close();
                                if (mysqli_fetch_array($result) > 0){
                                    foreach($result as $user){
                                        ?>
                                            <form action="user_edit_action.php" method="POST">
                                                <div class="form-group" >
                                                    <input hidden type="text" name="user_id" class="form-control" value=<?= $user['UserId'] ?>>  
                                                </div>
                                                <div class="form-group" style="margin-bottom: 25px;">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" value=<?= $user['UserName'] ?>>  
                                                </div>
                                                <div class="form-group" style="margin-bottom: 15px;">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" value=<?= $user['UserEmail'] ?>>
                                                </div>
                                                <div class="form-group" style="margin-bottom: 15px;">
                                                    <label>Status</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rdstatus" id="rdstatus1" value=1 <?=$user['UserStatus'] == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="rdstatus1">Hoạt động</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rdstatus" id="rdstatus0" value=0 <?=$user['UserStatus'] == 0 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="rdstatus0">Ngừng hoạt động</label>
                                                    </div>
                                                </div>
                                                <button name="update_user" class="btn btn-primary mt-2">Submit</button>
                                                <a href="user_list.php" class="btn btn-danger mt-2">Back</a>  
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

<?php include('../includes/footer.php');
?>
    

