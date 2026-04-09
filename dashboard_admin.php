<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center/cover;
    height: 100vh;
}

.overlay {
    background: rgba(0,0,0,0.7);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.dashboard-box {
    background: white;
    padding: 40px;
    border-radius: 20px;
    width: 350px;
    text-align: center;
}

h2 {
    margin-bottom: 25px;
    color: green;
}

.btn-custom {
    width: 100%;
    margin-bottom: 10px;
    border-radius: 10px;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="overlay">

<div class="dashboard-box">

<h2>🌿 Admin Dashboard</h2>

<a href="add_event.php" class="btn btn-success btn-custom">➕ Add Event</a>

<a href="events.php" class="btn btn-primary btn-custom">📋 View Events</a>

<a href="users.php" class="btn btn-info btn-custom">👥 Manage Users</a>

<a href="admin_feedback.php" class="btn btn-dark btn-custom">📊 Feedback Panel</a>

<a href="notifications.php" class="btn btn-warning btn-custom">🔔 Notifications</a>

<a href="logout.php" class="btn btn-danger btn-custom">🚪 Logout</a>

</div>

</div>

</body>
</html>