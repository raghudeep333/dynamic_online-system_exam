<?php include("../config/db.php"); ?>
<link rel="stylesheet" href="../css/style.css">

<div class="container">
<h2>Create Exam</h2>

<form method="POST">
<input type="text" name="title" placeholder="Exam Title" required>
<input type="datetime-local" name="start" required>
<input type="datetime-local" name="end" required>

<button name="create">Create Exam</button>
</form>

<?php
if(isset($_POST['create'])){
    $t = $_POST['title'];
    $s = $_POST['start'];
    $e = $_POST['end'];

    $conn->query("INSERT INTO exams(title,start_time,end_time) VALUES('$t','$s','$e')");
    echo "Exam Created!";
}
?>
</div>