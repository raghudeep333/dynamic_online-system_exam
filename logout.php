<<?php
session_start();

// destroy session
$_SESSION = [];
session_destroy();

// redirect properly
header("Location: /online_exam_system/login.php");
exit();
?>