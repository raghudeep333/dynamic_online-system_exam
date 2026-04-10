<?php
session_start();
include("../config/db.php");

// user id
$uid = $_SESSION['user']['id'];

// total exams
$total = $conn->query("SELECT COUNT(*) as t FROM exams")->fetch_assoc()['t'];

// exams taken
$taken = $conn->query("SELECT COUNT(*) as c FROM results WHERE user_id='$uid'")
              ->fetch_assoc()['c'];

// average score
$avg = $conn->query("SELECT AVG(score) as a FROM results WHERE user_id='$uid'")
            ->fetch_assoc()['a'];

$avg = $avg ? round($avg,2) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<h1 style="color:pink; padding-left:30px;">
Take  Get  Track 
</h1>

<!-- NAVBAR -->
<div class="navbar glass">
    <div class="logo">📘 ExamFlow</div>
    <a href="/online_exam_system/logout.php">
        <button class="btn">Logout</button>
    </a>
</div>

<!-- STATS -->
<div class="stats">

<div class="navbar glass">
    <h3><?php echo $total; ?></h3>
    <p>Available Exams</p>
</div>

<div class="stat-card">
    <h3><?php echo $taken; ?></h3>
    <p>Exams Taken</p>
</div>

<div class="stat-card">
    <h3><?php echo $avg; ?></h3>
    <p>Average Score</p>
</div>

</div>

<!-- EXAMS -->
<h2 class="title">Available Exams</h2>

<div class="cards">

<?php
$res = $conn->query("SELECT * FROM exams");

while($row = $res->fetch_assoc()){
?>

<div class="card">
    <span class="tag">B.Tech</span>

    <h3><?php echo $row['title']; ?></h3>
    <p>MCQ Test</p>

    <a href="exam.php?id=<?php echo $row['id']; ?>">
        <button class="btn">Start Exam</button>
    </a>
</div>

<?php } ?>

</div>

<!-- HISTORY -->
<h2 class="title">Your History</h2>

<div class="cards">

<?php
$res = $conn->query("
    SELECT results.score, exams.title 
    FROM results 
    JOIN exams ON results.exam_id = exams.id 
    WHERE results.user_id='$uid'
");

while($row = $res->fetch_assoc()){
    
    $percent = ($row['score'] / 5) * 100;

    if($percent >= 75){
        $color = "green";
    } elseif($percent >= 40){
        $color = "orange";
    } else {
        $color = "red";
    }
?>

<div class="card glass">
    <span class="tag">Completed</span>

    <h3><?php echo $row['title']; ?></h3>

    <p>Score: <?php echo $row['score']; ?>/5</p>

    <h2 style="color:<?php echo $color; ?>">
        <?php echo round($percent); ?>%
    </h2>
</div>

<?php } ?>

</div>
<h2 class="title">Your History</h2>

<div class="card glass">
<?php
$uid = $_SESSION['user']['id'];

$res = $conn->query("
    SELECT results.score, exams.title 
    FROM results 
    JOIN exams ON results.exam_id = exams.id 
    WHERE results.user_id='$uid'
");

while($row = $res->fetch_assoc()){
    
    $percent = ($row['score'] / 5) * 100;

    if($percent >= 75){
        $color = "green";
    } elseif($percent >= 40){
        $color = "orange";
    } else {
        $color = "red";
    }
?>

<div class="card">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['score']; ?>/5</p>
</div>

<?php } ?>   <!-- 🔥 THIS IS IMPORTANT -->

</div>

</body>
</html>