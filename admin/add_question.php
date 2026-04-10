<?php 
include("../config/db.php"); 
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Question</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="container">
<h2>Add Question</h2>

<form method="POST">

<!-- Select Exam -->
<select name="exam_id" required>
<option value="">Select Exam</option>

<?php
$exams = $conn->query("SELECT * FROM exams");
while($e = $exams->fetch_assoc()){
    echo "<option value='{$e['id']}'>{$e['title']}</option>";
}
?>
</select>

<input type="text" name="q" placeholder="Enter Question" required>
<input type="text" name="o1" placeholder="Option 1" required>
<input type="text" name="o2" placeholder="Option 2" required>
<input type="text" name="o3" placeholder="Option 3" required>
<input type="text" name="o4" placeholder="Option 4" required>

<input type="text" name="ans" placeholder="Correct Answer (exact text)" required>

<button type="submit" name="add">Add Question</button>

</form>

<?php
if(isset($_POST['add'])){
    $exam_id = $_POST['exam_id'];
    $q = $_POST['q'];
    $o1 = $_POST['o1'];
    $o2 = $_POST['o2'];
    $o3 = $_POST['o3'];
    $o4 = $_POST['o4'];
    $ans = $_POST['ans'];

    $sql = "INSERT INTO questions(question,option1,option2,option3,option4,answer,exam_id)
            VALUES('$q','$o1','$o2','$o3','$o4','$ans','$exam_id')";

    if($conn->query($sql)){
        echo "<p style='color:green;'>Question Added Successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error adding question!</p>";
    }
}
?>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>