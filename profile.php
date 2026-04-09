<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* UPDATE PROFILE */
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $bio = $_POST['bio'];

    $image = $_FILES['profile_pic']['name'];
    $tmp = $_FILES['profile_pic']['tmp_name'];

    if (!empty($image)) {
        move_uploaded_file($tmp, "uploads/".$image);
        mysqli_query($conn, "UPDATE users SET name='$name', bio='$bio', profile_pic='$image' WHERE id=$user_id");
    } else {
        mysqli_query($conn, "UPDATE users SET name='$name', bio='$bio' WHERE id=$user_id");
    }

    // ✅ FIX: redirect to same page (prevents 404)
    header("Location: " .$_SERVER['PHP_SELF']);
    exit();
}

/* FETCH USER DATA */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #56ab2f, #a8e063);
}

.overlay {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
}

.profile-box {
    background: white;
    padding: 25px;
    border-radius: 20px;
    width: 100%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.profile-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

h3 {
    color: #2e7d32;
    font-weight: bold;
}

.btn-custom {
    border-radius: 10px;
    font-weight: bold;
}
</style>

</head>

<body>

<div class="overlay">

<div class="profile-box">

<h3>👤 My Profile</h3>

<!-- PROFILE IMAGE -->
<img src="uploads/<?php echo !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.png'; ?>" class="profile-img">

<!-- FORM -->
<form method="POST" enctype="multipart/form-data" action="">

<input type="text" name="name" class="form-control mb-2"
value="<?php echo $user['name']; ?>" placeholder="Your Name" required>

<textarea name="bio" class="form-control mb-2" placeholder="Your Bio"><?php echo $user['bio']; ?></textarea>

<input type="file" name="profile_pic" class="form-control mb-2">

<button type="submit" name="update" class="btn btn-success w-100 btn-custom">
    💾 Update Profile
</button>

</form>

<!-- BACK BUTTON -->
<a href="dashboard_user.php" class="btn btn-dark w-100 mt-2 btn-custom">
    ⬅ Back
</a>

</div>

</div>

</body>
</html>