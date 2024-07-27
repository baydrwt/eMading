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
  #table-users_wrapper{
    width: 100%!important;
    padding: 10px;
  }
</style>
<script>
    function createUser(){
        $("#btn-user").removeAttr("onclick")
        $('#modalTitle').html('Create User');
        $('#btn-user').html('Create User');
        $('#username').val('')
        $('#email').val('');
        $('#role').val('');
        $('#btn-user').attr('onclick', 'insertUser()');
    }
  
    function insertUser(){
        var formData = new FormData();
        formData.append('action', 'INSERT_USER');
        formData.append('username',   $('#username').val());
        formData.append('email',   $('#email').val());
        formData.append('role',   $('#role').val());
        formData.append('password',   $('#password').val());

        $.ajax({
            url: 'user-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#table-users').DataTable().ajax.reload();
                Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "successful!",
                            showConfirmButton: false,
                            timer: 1000
                        });
            },
            error: function(e) {
                console.log('Error:', e);
            }
        });
    }

  function deletetUser(id){
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
            delete_user(id);
          }
        });
    }

    function delete_user(id) {
        var formData = new FormData();
        formData.append('action', "DELETE_USER");
        formData.append('id', id);

        $.ajax({
            url: 'user-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data) {
              $('#table-users').DataTable().ajax.reload();
              Swal.fire({
                title: "Deleted!",
                text: "User has been deleted.",
                icon: "success"
              });
            },
            error: function(e) {
                console.log('Error:', e);
            }
        });
    }

    function showEditUser(id){
        var formData = new FormData();
        formData.append('id', id);
        formData.append('action', 'SHOW_USER_EDIT');

        $.ajax({
            url: 'user-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
              $("#btn-user").removeAttr("onclick")
              $('#btn-user').attr('onclick', `updateUser(${id})`);
            },
            success: function(data) {
              $('#modalTitle').html('Edit User')
              $('#btn-user').html('Edit User')

              const user = JSON.parse(data);
              $('#username').val(user[0]['username'])
              $('#email').val(user[0]['email']);
              $('#role').val(user[0]['role']);
            },
            error: function(e) {
                console.log('Error:', e);
            }
        });
    }

    function updateUser(id){
        var formData = new FormData();
        formData.append('id', id);
        formData.append('action', 'UPDATE_USER');
        formData.append('username',   $('#username').val());
        formData.append('email',   $('#email').val());
        formData.append('role',   $('#role').val());

        $.ajax({
            url: 'user-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#table-users').DataTable().ajax.reload();
                Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "successful!",
                            showConfirmButton: false,
                            timer: 1000
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
              <h1 class="m-0 text-dark">MANAGE USERS</h1>
            </div>
          </div>
          <div class="row d-flex justify-content-end" style="gap:10px;padding-right:30px">
            <a type="button" class="btn pl-3 pr-3 pt-2 pb-2 text-white" style="background-color: #008000;" data-toggle="modal" data-target="#modal-user" onclick="createUser()">
              <i class="nav-icon fas fa-plus"></i> | Create User
            </a>
          </div>
          <div class="row mt-5 d-flex justify-content-center" style="width:100%!important">
            <table id="table-users" class="table table-striped table-bordered" style="width: 100%!important;">
              <thead>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
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

 <!-- Create User -->
 <div class="modal fade" id="modal-user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 7px;">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="modalTitle">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center pt-4 pb-3 pl-4 pr-4 mr-1">
          <!-- Form -->
          <form role="form" enctype="multipart/form-data" style="width:100%">
            <div class="form-group row d-flex justify-content-between">
              <div class="col-md-5 d-flex align-items-center">
                <label for="username" class="mb-0">Username</label>
              </div>
              <div class="col-md-7 text-center pr-0 pl-0">
                <input type="text" name="username" id="username" class="form-control">
              </div>
            </div>
            <div class="form-group row d-flex justify-content-between">
              <div class="col-md-5 d-flex align-items-center">
                <label for="email" class="mb-0">Email</label>
              </div>
              <div class="col-md-7 text-center pr-0 pl-0">
                <input type="email" name="email" id="email" class="form-control">
              </div>
            </div>
            <div class="form-group row d-flex justify-content-between">
              <div class="col-md-5 d-flex align-items-center">
                <label for="role" class="mb-0">Role</label>
              </div>
              <div class="col-md-7 text-center pr-0 pl-0">
                <input type="text" name="role" id="role" class="form-control">
              </div>
            </div>
            <div class="text-center">
              <button type="button" class="btn btn-primary pl-3 pr-3 mb-2 mt-2" id="btn-user" data-dismiss="modal" ></button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<script>
   jQuery(document).ready(function($) {

      const table = $('#table-users').DataTable({
                    responsive: true,
                    ajax: {
                        url: "users-script.php?request=GET_USERS",
                        dataSrc: ""
                    },
                    columns: [
                        {
                            data: 'username'
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'role'
                        },
                        {
                            data: {
                                'id': 'id',
                            },
                            render: function(data) {
                                return `
                                <div class="text-center ">
                                    <a class="btn btn-warning edit-button mr-1" data-toggle="modal" data-target="#modal-user" style="width:40px" onclick=showEditUser(${data.id})>
                                      <i class="fas fa-edit text-light"></i>
                                    </a>
                                    <a class="btn btn-danger delete-button" onclick=deletetUser(${data.id})>
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