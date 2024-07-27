<?php
require_once 'function.php';
$con = opendb('CONNECTION');

$id = $_POST['id'];

$sql = "SELECT image, category FROM emading.tbl_articles WHERE id='$id'";
$result = myQuery($con, $sql);

if ($result) {
    $row = fetch($result, "name");
    $imagePath = 'cover/'. $row['category'] . '/' . $row['image'];

    $deleteSql = "DELETE FROM emading.tbl_articles WHERE id='$id'";
    $deleteResult = myQuery($con, $deleteSql);

    if ($deleteResult) {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        } else {
        
        }
    } else {

    }
} else {

}
