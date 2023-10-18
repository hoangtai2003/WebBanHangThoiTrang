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
                        <h4>Phân quyền quản trị</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            $sql_role = "select * from role";
                            $result_role = mysqli_query($connection, $sql_role);
                            $query_run_role = mysqli_fetch_all($result_role, MYSQLI_ASSOC);
                            $sql_role_group = "select * from role_group order by role_group.position ASC";
                            $result_role_group = mysqli_query($connection, $sql_role_group);
                            $query_run_role_group = mysqli_fetch_all($result_role_group, MYSQLI_ASSOC);
                            $connection->close();
                        ?>
                        <form action="?action=save" method="POST">
                            <?php 
                                foreach($query_run_role_group as $group){

                            ?>
                                <div class="form-group">
                                    <h3><?=$group['name']?></h3>
                                    <ul style="display: inline-flex;list-style:none;width:100%;">
                                        <?php foreach($query_run_role as $role){ ?>
                                        <?php if ($role['role_group_id'] == $group['id']){ ?> 
                                        <li>
                                            <input type="checkbox" value="<?=$role['id'] ?>" id="<?=$role['id'] ?>" name="role[]">
                                            <label for="<?=$role['id'] ?>"><?=$role['name'] ?></label>
                                        </li>
                                        <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }?>
                            <button type="submit" class="btn btn-primary mt-2">Gửi đi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('../includes/footer.php');
?>
    

