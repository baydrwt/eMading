<?php
require_once 'function.php';
$con = opendb('CONNECTION');

session_start();

$user = $_SESSION['cUsername'];
$id = $_POST['id'];
$title = strtoupper(trim($_POST['title']));
$category = strtoupper(trim($_POST['category']));
$content = trim($_POST['content']);
$image = $_FILES['cover']['name'];
$extension = pathinfo($image, PATHINFO_EXTENSION);
$status =  strtoupper(trim($_POST['status']));

$sql = "update emading.tbl_articles set title='$title', category='$category', content='$content', image='$image', status='$status', update_user='$user' where id = '$id'";
$rs = myQuery($con, $sql);
if($rs){
    if(!file_exists($image)){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folderMain = 'cover/';
    
            $subFolderCategory = $folderMain . $category;
            if (!file_exists($subFolderCategory)) {
                mkdir($subFolderCategory, 0777, true);
            }
    
            $uploadedFile = $subFolderCategory . '/' . $image;
    
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadedFile)) {
                echo 'File berhasil diunggah.';
            } else {
                echo 'Gagal mengunggah file.';
            }
        }
    }
}
