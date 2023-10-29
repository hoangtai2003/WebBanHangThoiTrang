<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./myCategory.css">
    <title>Document</title>
</head>

<body>
    <?php
    include('../../config/config.php');
    include('../includes/header.php');
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    require_once('../../config/config.php');

    ?>
    <!-- container-category-->
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">category</li>
            <li class="breadcrumb-item active">My Category</li>
        </ol>
        <div class="Prod">
            <?php include('../authen/message.php'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Category</h4>
                        <a href="./createCategory.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Add category</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Miêu tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result=$connection->query("select * from categories");
                                while ($row = $result->fetch_assoc()){
                                    ?>
                                
                                        <tr>
                                            <td><?= $row['CateId']; ?></td>
                                            <td><?= $row['CateName']; ?></td>
                                            <td style="width: 150px"><img style="width: 150px;" src="../../images/<?= $row['CateImage']; ?>" alt=""></td>
                                            <td><?= $row['CateDescription']; ?></td>
                                            <td><?= $row['CateStatus']; ?></td>
                                            <td><a href="./editCategory.php?CateId=<?=$row['CateId'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Edit</a></td>
                                            <td>
                                                <form action="./deleteCategoryAction.php?CateId=<?=$row['CateId']?>" method="POST">
                                                    <button type="submit" onclick="return confirm('Are you sure delete <?= $row['CateName']; ?>?');" name="category_delete" class="btn btn-danger" value="<?= $row['CateId']; ?>"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>