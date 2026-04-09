<?php
$conn = mysqli_connect("localhost", "root", "", "ngo-portal");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>