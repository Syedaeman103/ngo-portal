<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM certificates WHERE user_id=$user_id");
?>

<!DOCTYPE html>
<html>
<head>
<title>Certificates</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #56ab2f, #a8e063);
}

.container {
    padding: 20px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 15px;
    text-align: center;
}
</style>
</head>

<body>

<div class="container">

<h2 class="text-white text-center">🎓 My Certificates</h2>

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<h5 class='text-white text-center'>No certificates available</h5>";
}

while ($row = mysqli_fetch_assoc($result)) {
?>

<div class="card">
    <h5><?php echo $row['title']; ?></h5>

    <a href="certificates/<?php echo $row['file']; ?>" class="btn btn-primary" download>
        ⬇ Download Certificate
    </a>
</div>

<?php } ?>

<a href="dashboard_user.php" class="btn btn-dark w-100">⬅ Back</a>

</div>

</body>
</html>