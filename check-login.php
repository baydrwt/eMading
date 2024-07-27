<?php
require_once "function.php";
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
date_default_timezone_set('Asia/Jakarta');

$con = opendb('CONNECTION');

session_start();
$uid = strtolower(htmlentities($_POST['user']));
$password = htmlentities($_POST['pass']);

if(!empty($uid) && !empty($password )){
  $sql = "select password from tbl_users where username='$uid'";

  $rs = myQuery($con, $sql);
  $rc = fetch($rs, 'number');

  $db_password = $rc[0];

  if (password_verify($password, $db_password)) {
    $sql = "select username, role from tbl_users where username='$uid'";
  
    $rs = myQuery($con, $sql);
    $rc = fetch($rs, 'number');
  
    $_SESSION['cUsername'] = $rc[0];
    $_SESSION['cRole'] = $rc[1];
    
    $login = array("username" => $rc[0]);
    
    echo json_encode($login);
  }else{
    http_response_code(503);
  }
}else{
  http_response_code(503);
}
closedb($con);
?>