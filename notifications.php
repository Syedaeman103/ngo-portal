<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(to right, #ff9966, #ff5e62);">

<div class="container mt-5">

<h2 class="text-center text-white mb-4">🔔 Notifications</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");

if(mysqli_num_rows($result) == 0){
    echo "<h4 class='text-white text-center'>No notifications</h4>";
}

while($row = mysqli_fetch_assoc($result)){
?>

<div class="card p-3 mb-3">
    <p><?php echo $row['message']; ?></p>
</div>

<?php } ?>

<a href="dashboard_admin.php" class="btn btn-dark w-100">⬅ Back</a>

</div>

</body>
</html>