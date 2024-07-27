<?php
require_once "function.php";
$con = opendb('CONNECTION');

session_start();

if(!isset($_SESSION['cUsername'])){
    header("Location: login.php");
  };

  $id = $_GET['id'];

  $sql = "select image, category, insert_user, title, content, updated_at, status from emading.tbl_articles where id='$id'";
  $rs = myQuery($con, $sql);
  $rc = fetch($rs, 'name');
  ?>  
  <!DOCTYPE html>
  <html>

  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eMading - Manage Article</title>
  <?php
  include "header.php";

  ?>
</head>
<style>
    p{
        margin-top:0px!important;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    include 'menu.php';
    ?>

    <!-- Section -->
    <section class="content">
        <div class="content-wrapper">   
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Article Detail</h1>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-center pt-5 pl-5 pr-5 pb-3">
                        <div class="card-form p-5 mb-4" style="width:80%;background-color: #F3F0CA;border-radius:10px;border:1px solid #E1AA74">
                            <h2 class="text-center mb-5" style="font-weight: 550;"><?= $rc['title'] ?></h2>
                            <form role="form" enctype="multipart/form-data" style="width:100%">
                                <div class="form-group row">
                                    <div class="col-lg-12 pl-0 d-flex justify-content-between">
                                        <p class="pl-2">Status  : <?= $rc['status'] ?></p>
                                        <p class="pl-2">Last Updated : <?= $rc['updated_at'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-center pb-4">
                                    <div class="col-lg-12 text-center">
                                        <img src="cover/<?=$rc['category'] ?>/<?=$rc['image'] ?>" alt="" style="width:350px;height:auto;border-radius:20px">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <label for="title" class="mb-0" style="font-size:20px">Author</label>
                                    </div>
                                    <div class="col-lg-1 pl-0">
                                        <p class="mb-0">:</p>
                                    </div>
                                    <div class="col-lg-9 pl-0 d-flex align-items-center">
                                        <p class="mb-0"><?= $rc['insert_user'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <label for="category" class="mb-0" style="font-size:20px">Category</label>
                                    </div>
                                    <div class="col-lg-1 pl-0">
                                        <p class="mb-0">:</p>
                                    </div>
                                    <div class="col-lg-9 pl-0 d-flex align-items-center">
                                        <p class="mb-0"><?= $rc['category'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2">
                                        <label for="content" class="mb-0" style="font-size:20px">Content</label>
                                    </div>
                                    <div class="col-lg-1 pl-0">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-9 pl-0 d-flex flex-column align-items-center">
                                        <p class="mb-0"><?= $rc['content']?></p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
    <?php
    include 'footer.php';
    ?>
</body>
</html> 