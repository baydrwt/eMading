<?php
require_once "function.php";
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
  <title>eMading - Manage Article</title>
  <?php
  include "header.php";

  ?>
</head>
<style>
  #table-articles_wrapper{
    width: 100%!important;
    padding: 10px;
  }
</style>
<script>
  
  function deleteArticle(id){
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            delete_article(id);
          }
        });
    }

  function delete_article(id) {
        var formData = new FormData();
        formData.append('id', id);

        $.ajax({
            url: 'delete-article-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data) {
              $('#table-articles').DataTable().ajax.reload();
              Swal.fire({
                title: "Deleted!",
                text: "Your article has been deleted.",
                icon: "success"
              });
            },
            error: function(e) {
                console.log('Error:', e);
            }
        });
    }
</script>
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
              <h1 class="m-0 text-dark">MANAGE ARTICLE</h1>
            </div>
          </div>
          <div class="row d-flex justify-content-end" style="gap:10px;padding-right:30px">
            <a type="button" class="btn pl-3 pr-3 pt-2 pb-2 text-white" style="background-color: #008000;" href="create-article.php">
              <i class="nav-icon fas fa-plus"></i> | Create Article
            </a>
          </div>
          <div class="row mt-5 d-flex justify-content-center" style="width:100%!important">
            <table id="table-articles" class="table table-striped table-bordered" style="width: 100%!important;">
              <thead>
                <th>Cover</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
<script>
   jQuery(document).ready(function($) {

      const table = $('#table-articles').DataTable({
                    responsive: true,
                    ajax: {
                        url: "article-script.php?action=GET_ARTICLES",
                        dataSrc: ""
                    },
                    columns: [
                        {
                            data: {
                                'cover': 'cover',
                                'category': 'category'
                            },
                            render: function(data) {
                                return `
                                    <img class="mb-0" src="cover/${data.category}/${data.cover}" width="200px"></img>
                                    `
                            }
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'insert_user'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: {
                                'id': 'id',
                            },
                            render: function(data) {
                                return `
                                <div class="text-center d-flex">
                                    <a class="btn btn-primary edit-button mr-1" href="article-detail.php?id=${data.id}" style="width:40px"style="width:40px">
                                      <i class="fas fa-file-invoice text-light"></i>
                                    </a>
                                    <a class="btn btn-warning edit-button mr-1" href="edit-article.php?id=${data.id}" style="width:40px"style="width:40px">
                                      <i class="fas fa-edit text-light"></i>
                                    </a>
                                    <a class="btn btn-danger delete-button" onclick=deleteArticle(${data.id})>
                                      <i class="fas fa-trash text-light"></i>
                                    </a>
                                </div>
                                `
                            }
                        },
                    ],
                    language: {
                        emptyTable: 'Loading data from database...'
                    }
                });
      });
</script>
  <?php
  include 'footer.php';
  ?>

</body>
</html>