<?php
session_start();
include "config.php";

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
    $message = $_POST['message'];
    $rating = $_POST['rating'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $image);

    mysqli_query($conn, "INSERT INTO feedback (user_id, message, rating, image) 
    VALUES ($user_id, '$message', '$rating', '$image')");

    echo "<script>alert('Feedback Submitted');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Feedback</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(to right, #ff9a9e, #fad0c4);">

<div class="container mt-5">
<div class="card p-4 shadow">

<h3 class="text-center">📸 Give Feedback</h3>

<form method="POST" enctype="multipart/form-data">

<textarea name="message" class="form-control mb-3" placeholder="Your feedback"></textarea>

<select name="rating" class="form-control mb-3">
<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>
</select>

<input type="file" name="image" class="form-control mb-3">

<button name="submit" class="btn btn-success w-100">Submit</button>

</form>

</div>
</div>

</body>
</html>