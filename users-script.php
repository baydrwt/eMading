<?php
require_once 'function.php';
$con = opendb('CONNECTION');

$request = $_GET['request'];

if($request == 'GET_USERS'){
    $sql = "select id, username, email, role from emading.tbl_users";
    $rs = myQuery($con, $sql);

    $users = array();
    while($rc = fetch($rs, 'name')){
    array_push($users, array(
        'id' => $rc['id'],
        'username' => $rc['username'],
        'email' => $rc['email'],
        'role' => $rc['role'],
    ));
    };
    echo json_encode($users);
}
