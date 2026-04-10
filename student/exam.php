<?php 
session_start();
include("../config/db.php");

$exam_id = $_GET['id'];
$q = $conn->query("SELECT * FROM questions WHERE exam_id='$exam_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Exam</title>
<link rel="stylesheet" href="../css/style.css">

<script>
// ⏱️ 60 seconds timer (you can change)
let timeLeft = 60;

function startTimer(){
    let timer = setInterval(function(){
        document.getElementById("timer").innerText = timeLeft + " sec";

        timeLeft--;

        if(timeLeft < 0){
            clearInterval(timer);
            alert("Time Up! Auto submitting...");
            document.getElementById("examForm").submit();
        }
    },1000);
}
</script>

</head>

<body onload="startTimer()">

<div class="navbar">
    <div class="logo">📘 ExamFlow</div>
    <div id="timer" style="color:red; font-weight:bold;"></div>
</div>

<div class="cards">
<form method="POST" action="result.php" id="examForm">

<?php while($row = $q->fetch_assoc()){ ?>

<div class="card">
    <p><b><?php echo $row['question']; ?></b></p>

    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option1']; ?>"> <?php echo $row['option1']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option2']; ?>"> <?php echo $row['option2']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option3']; ?>"> <?php echo $row['option3']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option4']; ?>"> <?php echo $row['option4']; ?><br>
</div>

<?php } ?>

<button class="btn">Submit</button>

</form>
</div>
<script>
// 🚫 Disable refresh (F5 + Ctrl+R)
document.addEventListener("keydown", function(e){
    if(e.key === "F5" || (e.ctrlKey && e.key === "r")){
        e.preventDefault();
    }
});

// 🚫 Disable back button
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};
</script>

</body>
</html>