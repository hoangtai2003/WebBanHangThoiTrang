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
                <h1 class="mt-4">Menu</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Menu</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-success m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Menu</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>
                                                <a href="" class="btn btn-default">Edit</a>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include('includes/footer.php');
?>
    

