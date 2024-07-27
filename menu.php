<?php
require_once "function.php";
$con = opendb('CONNECTION');
?>

<style>
  .dropdown-toggle::after {
    display: none;
  }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
</ul>

<ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fas fa-user-circle fa-lg"></i>
</a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-item">
          <div class="media">
            <img src="./img/profile-user.svg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <?= $_SESSION['cUsername']; ?>
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm"><?= $_SESSION['cRole'] ?></p>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <a href="logout.php" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
      </div>
    </li>
</ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index.php" class="brand-link pl-4">
    <span class="brand-text font-weight-light">eMading JeWePe</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="article.php" class="nav-link">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Manage Article</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="users.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Users</p>
          </a>
        </li>
      </ul>
      <br>
    </nav>
  </div>
</aside>

<script>
  $(document).ready(function () {
    $('.dropdown-toggle').click(function () {
      $(this).next('.dropdown-menu').toggle();
    });
  });
</script>
