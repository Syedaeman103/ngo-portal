<?php
include "config.php";

if (isset($_POST['upload'])) {

    $user_id = $_POST['user_id'];
    $title = $_POST['title'];

    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    move_uploaded_file($tmp, "certificates/".$file);

    mysqli_query($conn, "INSERT INTO certificates (user_id, title, file) 
    VALUES ('$user_id', '$title', '$file')");

    echo "<script>alert('Certificate Uploaded!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Certificate</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg,#56ab2f,#a8e063);">

<div class="container mt-5">
<div class="card p-4">

<h3>Upload Certificate</h3>

<form method="POST" enctype="multipart/form-data">

<input type="number" name="user_id" class="form-control mb-2" placeholder="User ID" required>

<input type="text" name="title" class="form-control mb-2" placeholder="Certificate Title" required>

<input type="file" name="file" class="form-control mb-2" required>

<button name="upload" class="btn btn-success w-100">Upload</button>

</form>

</div>
</div>

</body>
</html>