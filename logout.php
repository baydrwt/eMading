<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
date_default_timezone_set('Asia/Jakarta');
session_start();


session_destroy();
header("Location: login.php");

?>