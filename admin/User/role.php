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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Phân quyền quản trị</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty($_GET['action']) && $_GET['action'] == "save") {      
                        $userId = $_POST['UserId'];
                        $roles = $_POST['roles'];
                        $insertString = "";
                        $deleteOldRole = mysqli_query($connection, "Delete from roleuser where UserId = " .$userId);
                        foreach ($roles as $insertRole) {
                            $insertString .= !empty($insertString) ? "," : "";
                            $insertString .= "(NULL, " . $userId . ", " . $insertRole . ", current_timestamp(), current_timestamp())";
                        }
                        $resultRole = mysqli_query($connection, "INSERT INTO roleuser (id, UserId, RoleId, created_at, updated_at) VALUES " . $insertString);
                        if(!$resultRole){
                            $error = "Phân quyền không thành công. Xin mời thử lại";
                        } 
                    ?>
                    <?php if(!empty($error)){ ?>
                        <p><?php echo $error; ?></p>
                    <?php } else { ?>
                        Phân quyền thành công . <a href="user_list.php">Quay lại danh sách thành viên</a>
                    <?php } ?>
                    <?php } else { ?>
                        <?php
                        $result_role = mysqli_query($connection,  "select * from role");
                        $query_run_role = mysqli_fetch_all($result_role, MYSQLI_ASSOC);

                        $result_role_group = mysqli_query($connection, "select * from role_group order by role_group.position ASC");
                        $query_run_role_group = mysqli_fetch_all($result_role_group, MYSQLI_ASSOC);

                        $currentRole =  mysqli_query($connection,  "select * from roleuser where UserId=". $_GET['UserId']);
                        $currentRole_run =  mysqli_fetch_all($currentRole, MYSQLI_ASSOC);
                        $currentRoleList = array();
                        if(!empty($currentRole_run)){
                            foreach($currentRole_run as $current){
                                $currentRoleList[] = $current['RoleId'];
                            }
                        }
                        $connection->close();
                        ?>
                        <form action="?action=save" method="POST">
                            <input type="hidden" name="UserId" value="<?= $_GET['UserId'] ?>">
                            
                            <?php
                            foreach ($query_run_role_group as $key => $group) {
                            ?>
                            <div class="col-md-12">
                                <div class="card mb-3 col-md-12">
                                    <div class="card-header" style="background: #3de4e4;">
                                        <label>
                                            <input type="checkbox" class="<?='checkbox_wrapper_'.$key?>">
                                            
                                            <b style="font-weight: 500; font-size: 25px;"><?= $group['name'] ?></b>
                                        </label>
                                    </div>
                                    <div class="card-body">
                                        <ul style="display: flex;list-style:none;width:100%;">
                                            <?php foreach ($query_run_role as $role) { ?>
                                                <?php if ($role['role_group_id'] == $group['id']) { ?>
                                                    <li style="float: left;width: 20%;font-size:18px;">
                                                        <input type="checkbox" 
                                                            <?php if(in_array($role['id'], $currentRoleList)){ ?>                                                            
                                                            checked="" <?php }?>
                                                        value="<?= $role['id'] ?>" id="<?= $role['id'] ?>" name="roles[]" class="<?='checkbox_children_'.$key?>">
                                                        <label for="<?= $role['id'] ?>"><?= $role['name'] ?></label>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <button class="btn btn-primary mt-2">Gửi đi</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');
?>
