<?php
session_start();
include "config.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Feedback</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(to right, #36d1dc, #5b86e5);">

<div class="container mt-5">

<h2 class="text-center text-white mb-4">📊 Admin Feedback Panel</h2>

<?php
$result = mysqli_query($conn, "SELECT f.*, u.name FROM feedback f 
JOIN users u ON f.user_id = u.id");

while($row = mysqli_fetch_assoc($result)){
?>

<div class="card p-3 mb-3 shadow">

<h5>👤 <?php echo $row['name']; ?></h5>

<p>💬 <?php echo $row['message']; ?></p>

<p>⭐ Rating: <?php echo $row['rating']; ?>/5</p>

<?php if($row['image']){ ?>
<img src="uploads/<?php echo $row['image']; ?>" width="150" class="mt-2">
<?php } ?>

</div>

<?php } ?>

<a href="dashboard_admin.php" class="btn btn-dark w-100">⬅ Back</a>

</div>

</body>
</html>