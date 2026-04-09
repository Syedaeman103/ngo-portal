<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT users.*, roles.role_name 
            FROM users 
            JOIN roles ON users.role_id = roles.id 
            WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // ✅ Handle BOTH plain + hashed passwords
        if ($password === $row['password'] || password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role_name'];

            if ($row['role_name'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit();

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center center/cover;
}
.login-box {
    background: rgba(255,255,255,0.9);
    padding: 30px;
    border-radius: 15px;
    width: 350px;
}
</style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="login-box">
    <h3 class="text-center text-success">🌿 NGO Portal Login</h3>

    <?php if(isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-success w-100">Login</button>
    </form>

    <p class="text-center mt-2">
        <a href="register.php">Create account</a>
    </p>
</div>

</body>
</html>