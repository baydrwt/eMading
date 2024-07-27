<?php
require_once 'function.php';
$con = opendb('CONNECTION');
session_start();

if(!isset($_SESSION['cUsername'])){
  header("Location: login.php");
};
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eMading - Home</title>
  <?php
  include "header.php";
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <?php
  include 'menu.php';
  ?>

<section class="content">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Welcome Back, <?= $_SESSION['cUsername'] ?>!</h1>
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