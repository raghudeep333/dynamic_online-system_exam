<?php
session_start();
include("config/db.php");
?>

<link rel="stylesheet" href="../css/style.css">

<div class="navbar">
    <div class="logo">📘 ExamFlow</div>
    <a href="../logout.php">Logout</a>
</div>

<h2 style="padding:20px;">Available Exams</h2>

<div class="cards">

<?php
$res = $conn->query("SELECT * FROM exams");

while($row = $res->fetch_assoc()){
?>
    <div class="card">
        <h3><?php echo $row['title']; ?></h3>
        <p>B.Tech MCQ Test</p>

        <a href="exam.php?id=<?php echo $row['id']; ?>">
            <button class="btn">Start Exam</button>
        </a>
    </div>
<?php } ?>

</div>