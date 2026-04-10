<?php 
session_start();
include("config/db.php"); 

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $res = $conn->query("SELECT * FROM users WHERE name='$u' AND password='$p'");

    if($res && $res->num_rows > 0){
        $row = $res->fetch_assoc();
        $_SESSION['user'] = $row;

        if($row['role'] == 'admin'){
            header("Location: admin/dashboard.php");
        } else {
            header("Location: student/home.php");
        }
        exit();
    } else {
        $error = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="form-box">
<h2>Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

</div>

</body>
</html>