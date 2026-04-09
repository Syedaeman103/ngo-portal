<?php
session_start();

// Set language
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "en";
}

// Load language file
include "lang/" . $_SESSION['lang'] . ".php";
?>