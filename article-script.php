<?php
require_once 'function.php';
$con = opendb('CONNECTION');

$action = $_GET['action'];

if($action == 'GET_ARTICLES'){
$sql = "select id, image, title, category, insert_user, created_at, status from emading.tbl_articles";
$rs = myQuery($con, $sql);

$articles = array();
while($rc = fetch($rs, 'name')){
  array_push($articles, array(
    'id' => $rc['id'],
    'cover' => $rc['image'],
    'title' => $rc['title'],
    'category' => $rc['category'],
    'insert_user' => $rc['insert_user'],
    'created_at' => $rc['created_at'],
    'status' => $rc['status'],
  ));
};
echo json_encode($articles);
}