<?php
session_start();

    include('../../config/config.php');
    include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
?>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
        </ol>
        <div class="row">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Danh sách thành viên</h4>
                        <?php if(checkPrivilege('user_add.php')) { ?>
                            <a href="user_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Phân quyền</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "Select * from users";
                                    $result = mysqli_query($connection,$sql);
                                    if (mysqli_fetch_array($result) > 0){
                                        foreach($result as $row){
                                            ?>
                                                <tr>
                                                    <th scope="row"><?=$row['UserId'];?></th>
                                                    <td><?=$row['UserName'];?></td>
                                                    <td><?=$row['UserEmail'];?></td>
                                                    <td><?php
                                                            if($row['UserStatus']==1){
                                                                ?>
                                                                    <span class="badge rounded-pill bg-success p-3">Hoạt động</span>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                    <span class="badge rounded-pill bg-success p-3">Ngừng hoạt động</span>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><a class="btn btn-info rounded-pill p-2">Phân quyền</a></td>
                                                    <?php if(checkPrivilege('user_edit.php?UserId=0')) { ?>
                                                        <td>
                                                            <a 
                                                                href="user_edit.php?UserId=<?=$row['UserId']?>" 
                                                                class="btn btn-success">
                                                                <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                                            </a>
                                                        </td>
					                                <?php } ?>
                                                    <form action="user_delete_action.php" method="POST">
                                                        <td>
                                                            <button
                                                                type="submit" 
                                                                onclick="return confirm('Are you sure delete <?=$row['UserName'];?>?');" 
                                                                name="user_delete" 
                                                                class="btn btn-danger" 
                                                                value="<?=$row['UserId'];?>"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Xóa
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
    

