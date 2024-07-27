<?
require_once "function.php";

session_start();

$con = opendb('CONNECTION');

$user = $_SESSION['cUsername'];
$title = strtoupper(trim($_POST['title']));
$category = strtoupper(trim($_POST['category']));
$content = trim($_POST['content']);
$image = $_FILES['cover']['name'];
$extension = pathinfo($image, PATHINFO_EXTENSION);
$status =  strtoupper(trim($_POST['status']));

$sql = "insert into emading.tbl_articles(title, category, content, image, status, insert_user) values ('$title','$category','$content','$image','$status','$user')";
$rs = myQuery($con, $sql);
if($rs){
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

