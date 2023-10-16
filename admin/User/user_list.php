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
            <li class="breadcrumb-item active">List</li>
        </ol>
        <div class="row">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List User</h4>
                        <a href="user_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Add Admin</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "Select * from user";
                                    $result = mysqli_query($connection,$sql);
                                    if (mysqli_fetch_array($result) > 0){
                                        foreach($result as $row){
                                            ?>
                                                <tr>
                                                    <th scope="row"><?=$row['UserId'];?></th>
                                                    <td><?=$row['UserName'];?></td>
                                                    <td><?=$row['UserEmail'];?></td>
                                                    <td><a href="user_edit.php?UserId=<?=$row['UserId']?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Edit</a></td>
                                                    <form action="user_delete_action.php" method="POST">
                                                    <td>
                                                        <button 
                                                            type="submit" 
                                                            onclick="return confirm('Are you sure delete <?=$row['UserName'];?>?');" 
                                                            name="user_delete" 
                                                            class="btn btn-danger" 
                                                            value="<?=$row['UserId'];?>"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Delete
                                                        </button>
                                                    </td>
                                                    </form>
                                                </tr>
                                            <?php
                                        }
                                    }
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
    

