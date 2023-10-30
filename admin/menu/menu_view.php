<?php
    session_start();
   
    if(!isset($_SESSION["menu_error"])){
        $_SESSION["menu_error"]="";
    }
    include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");
    $result= $connection->query("select * from menu ");
?>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Menu</li>
            <li class="breadcrumb-item active">Fix</li>
        </ol>
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Menu</h4>
                        <a href="menu_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Add new menu</a>
                    </div>
            <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>MenuID</th>
                <th>MenuName</th>
                <th>Link</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            
                <?php 
                while($row= $result->fetch_assoc()){
                    ?>
            <tr>

            <td><?php echo $row["MenuId"];?></td>
            <td><?php echo $row["MenuName"];?></td>
            <td><?php echo $row["MenuLink"];?></td>
            <td>
                <a class="btn btn-success" href="menu_edit.php?MenuId=<?php echo $row["MenuId"];?>"><i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Edit</a>
            </td>

            <td>
                <a class="btn btn-danger"  onclick="return confirm('Are you sure to delete <?php echo $row["MenuId"]; ?> ?');" href="menu_delete.php?MenuId=<?php echo $row["MenuId"];?>"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Delete</a>
            </td>
           
            </tr>
            <?php

                }
                $connection->close();
            ?>
            

        </table>
            </div>
            </div>
                </div>
        </div>
    </div>
    </body>
</html>
<?php 
    unset($_SESSION["menu_error"]);

