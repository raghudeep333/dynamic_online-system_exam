<?php 
include("config/db.php"); 
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="form-box glass">
<h2>Register</h2>

<form method="POST">
<input type="text" name="username" placeholder="Enter Username" required>
<input type="password" name="password" placeholder="Enter Password" required>

<select name="role">
<option value="student">Student</option>
<option value="admin">Admin</option>
</select>

<button type="submit" name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $r = $_POST['role'];

    // 🔥 FIX HERE (name column)
    $conn->query("INSERT INTO users(name,password,role) VALUES('$u','$p','$r')");

    // ✅ REDIRECT
    header("Location: login.php");
    exit();
}
?>

<p>Already have account? <a href="login.php">Login</a></p>

</div>

</body>
</html>