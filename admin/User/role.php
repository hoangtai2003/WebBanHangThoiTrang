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
                    if (!empty($_GET['action']) && $_GET['action'] == "save") {
                        $data = $_POST;
                        $insertString = "";
                        $deleteOldRole = mysqli_query($connection, "Delete from roleuser where UserId = " .$data['UserId']);
                        foreach ($data['roles'] as $insertRole) {
                            $insertString .= !empty($insertString) ? "," : "";
                            $insertString .= "(NULL, " . $data['UserId'] . ", " . $insertRole . ", current_timestamp(), current_timestamp())";
                        }
                        $insertRole = mysqli_query($connection, "INSERT INTO roleuser (id, UserId, RoleId, created_at, updated_at) VALUES " . $insertString);
                    ?>
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
                            foreach ($query_run_role_group as $group) {

                            ?>
                                <div class="form-group">
                                    <h3><?= $group['name'] ?></h3>
                                    <ul style="display: flex;list-style:none;width:100%;">
                                        <?php foreach ($query_run_role as $role) { ?>
                                            <?php if ($role['role_group_id'] == $group['id']) { ?>
                                                <li style="float: left;width: 20%;">
                                                    <input type="checkbox" 
                                                        <?php if(in_array($role['id'], $currentRoleList)){ ?>                                                            
                                                        checked="" <?php }?>
                                                    value="<?= $role['id'] ?>" id="<?= $role['id'] ?>" name="roles[]">
                                                    <label for="<?= $role['id'] ?>"><?= $role['name'] ?></label>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
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
