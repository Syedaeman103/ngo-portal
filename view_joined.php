<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$sql = "SELECT users.name, users.email, events.event_name, events.event_date
        FROM event_registrations
        JOIN users ON event_registrations.user_id = users.id
        JOIN events ON event_registrations.event_id = events.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Joined Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Users Joined Events</h2>

<table class="table table-bordered mt-3">
    <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Event Name</th>
        <th>Date</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['event_name']; ?></td>
        <td><?php echo $row['event_date']; ?></td>
    </tr>
    <?php endwhile; ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</body>
</html>