<?php
session_start();
include "config.php";

if ($_SESSION['role'] == 'admin') {
    $id = $_GET['id'];
    mysqli_query($conn,"DELETE FROM feedback WHERE id=$id");
}

header("Location: admin_feedback.php");
?>