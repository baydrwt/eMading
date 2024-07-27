<?php
require_once 'function.php';
$con = opendb('CONNECTION');

$action = $_POST['action'];

if($action == 'INSERT_USER'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "insert into emading.tbl_users(username, email, role, password) values('$username', '$email', '$role', '$password')";
    $rs = myQuery($con, $sql);

    if($rs){

    }else{
        http_response_code(503);
    }
}else if($action == 'DELETE_USER'){
    $id = $_POST['id'];
    $sql = "DELETE FROM emading.tbl_users WHERE id='$id'";
    $rs = myQuery($con, $sql);

    if($rs){

    }else{
        http_response_code(503);
    }
}else if($action == 'SHOW_USER_EDIT'){
    $id = $_POST['id'];
    $sql = "select id, username, email, role from emading.tbl_users where id='$id'";
    $rs = myQuery($con, $sql);
    
    $users = array();
    $rc = fetch($rs, 'name');
      array_push($users, array(
        'id' => $rc['id'],
        'username' => $rc['username'],
        'email' => $rc['email'],
        'role' => $rc['role'],
      ));
    
    echo json_encode($users);
}else if($action == 'UPDATE_USER'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $id = $_POST['id'];
    $sql="update emading.tbl_users set username='$username', email='$email', role='$role' where id = '$id'";
    $rs = myQuery($con, $sql);

    if($rs){

    }else{
        http_response_code(503);
    }
}