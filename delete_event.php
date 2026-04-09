<?php
session_start();
include "config.php";

// ✅ Only admin can delete
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// OPTIONAL: if you have role system
// if ($_SESSION['role'] != 'admin') {
//     die("Access Denied");
// }

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Delete query
    mysqli_query($conn, "DELETE FROM events WHERE id = $id");

    echo "<script>
        alert('Event Deleted Successfully!');
        window.location='events.php';
    </script>";
}
?>