<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 🔒 secure
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role_id)
            VALUES ('$name','$email','$password','$role')";

    if (mysqli_query($conn, $sql)) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(to right, #56ab2f, #a8e063);
}
.register-box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    width: 350px;
}
</style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="register-box">
    <h3 class="text-center text-success">🌱 Register</h3>

    <?php if(isset($success)) echo "<p class='text-success'>$success</p>"; ?>
    <?php if(isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

        <select name="role" class="form-control mb-2">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>

        <button class="btn btn-success w-100">Register</button>
    </form>

    <p class="text-center mt-2">
        <a href="login.php">Already have account?</a>
    </p>
</div>

</body>
</html>