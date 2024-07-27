<?
require_once 'function.php';
$con = opendb('CONNECTION');

session_start();

$id = $_GET['id'];

$sql = "select image, category, insert_user, title,content, created_at from emading.tbl_articles where id='$id'";
$rs = myQuery($con, $sql);
$rc = fetch($rs, 'name');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eMading JeWePe</title>
  <?php
  include "header.php";
  ?>
</head>
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding:0;
}

body{
    background: #1B2223;
}

p{
    color:#F4FEFD!important;
    margin-top:0px!important;
}
</style>
<body class="hold-transition">
<nav class="main-header navbar navbar-expand navbar-white navbar-dark ml-0" style="background-color:#1B2223">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">eMading JeWePe</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION["cUsername"])) { ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, <?= $_SESSION["cUsername"] ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="home.php" class="dropdown-item">
                                <svg class="mb-1 pr-1" height="16px" viewBox="0 0 384 512">
                                    <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z" />
                                </svg>
                                Menu</a>
                            <a href="logout.php" class="dropdown-item" title="Sign Out">
                                <svg class="mb-1" height="16px" viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                </svg>
                                Sign Out</a>
                        </div>
                    </div>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a href="index.php" class="nav-link" title="Sign In">Sign In
                        <svg height="16px" class="pl-1" viewBox="0 0 512 512">
                            <path fill="#777777" d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                        </svg>
                    </a>
                </li>
            <?php } ?>
        </ul>
</nav>
<section>
    <div class="container">
        <div class="header text-center d-flex justify-content-center flex-column align-items-center mb-4">
            <h1 class="text-center text-white m-4 pb-4" style="width:70%"><?=$rc['title'] ?></h1>
            <img src="./img/profile-user.svg" alt="User Avatar" class="img-size-50 img-circle mb-3">
            <p class="text-center text-white" style="width:30%"><?=$rc['insert_user'] ?></p>
            <p class="text-center text-white" style="width:30%"><?=$rc['created_at'] ?></p>
        </div>
        <div class="body mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <img src="cover/<?=$rc['category'] ?>/<?=$rc['image'] ?>" alt="" style="width:300px;height:auto;border-radius:20px">
                    </div>
                    <div class="col-md-8">
                        <p class="text-white mt-0"><?=$rc['content'] ?></p>
                    </div>
                </div>
        </div>
    </div>
</section>
</body>