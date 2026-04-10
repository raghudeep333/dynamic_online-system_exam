<?php
session_start();
include("../config/db.php");

$q = $conn->query("SELECT * FROM questions");

$total = 0;
$score = 0;

while($row = $q->fetch_assoc()){
    $total++;
    $qid = "q".$row['id'];

    if(isset($_POST[$qid]) && $_POST[$qid] == $row['answer']){
        $score++;
    }
}

$percent = ($score/$total)*100;

// 🎨 color logic
if($percent >= 75){
    $color = "green";
} elseif($percent >= 40){
    $color = "orange";
} else {
    $color = "red";
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="form-box">
<h2>Result</h2>

<canvas id="myChart"></canvas>

<h3>Score: <?php echo $score; ?>/<?php echo $total; ?></h3>
<h2><?php echo round($percent); ?>%</h2>

<a href="home.php"><button class="btn">Dashboard</button></a>
</div>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Correct', 'Wrong'],
        datasets: [{
            data: [<?php echo $score; ?>, <?php echo $total - $score; ?>],
            backgroundColor: ['green', 'red']
        }]
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>