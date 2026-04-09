<?php
session_start();
include "config.php";

if (isset($_POST['submit'])) {

    $event_name = $_POST['event_name'];
    $event_name_hi = $_POST['event_name_hi'];
    $event_name_kn = $_POST['event_name_kn'];

    $description = $_POST['description'];
    $description_hi = $_POST['description_hi'];
    $description_kn = $_POST['description_kn'];

    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];

    mysqli_query($conn, "INSERT INTO events 
    (event_name, event_name_hi, event_name_kn, description, description_hi, description_kn, event_date, event_time, venue)
    VALUES 
    ('$event_name','$event_name_hi','$event_name_kn','$description','$description_hi','$description_kn','$event_date','$event_time','$venue')");

    echo "<script>alert('✅ Event Added Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Event</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center/cover;
}

.overlay {
    background: rgba(0,0,0,0.7);
    min-height: 100vh;
    padding: 30px;
}

.card {
    max-width: 450px;
    margin: auto;
    padding: 25px;
    border-radius: 20px;
}

h3 {
    text-align: center;
    color: #2e7d32;
    font-weight: bold;
}
</style>

</head>

<body>
    
    <div class="bg-dark p-2 text-center">

<a href="dashboard_admin.php" class="btn btn-light">🏠 Home</a>

<a href="add_event.php" class="btn btn-success">➕ Add Event</a>

<a href="manage_events.php" class="btn btn-primary">📋 Manage Events</a>

<a href="admin_feedback.php" class="btn btn-warning">📊 Feedback</a>

<a href="notifications.php" class="btn btn-info">🔔 Notifications</a>

<a href="logout.php" class="btn btn-danger">🚪 Logout</a>

</div>

<div class="overlay">

<div class="card">

<h3>🌿 Add Event</h3>

<form method="POST">

<input type="text" id="event_name" name="event_name" class="form-control mb-2"
placeholder="Event Name (English)" required onkeyup="translateText()">

<input type="text" id="event_name_hi" name="event_name_hi" class="form-control mb-2"
placeholder="Hindi (Auto)">

<input type="text" id="event_name_kn" name="event_name_kn" class="form-control mb-2"
placeholder="Kannada (Auto)">

<textarea id="description" name="description" class="form-control mb-2"
placeholder="Description (English)" onkeyup="translateText()"></textarea>

<textarea id="description_hi" name="description_hi" class="form-control mb-2"
placeholder="Hindi (Auto)"></textarea>

<textarea id="description_kn" name="description_kn" class="form-control mb-2"
placeholder="Kannada (Auto)"></textarea>

<input type="date" name="event_date" class="form-control mb-2" required>

<input type="time" name="event_time" class="form-control mb-2" required>

<input type="text" name="venue" class="form-control mb-3"
placeholder="📍 Venue" required>

<button name="submit" class="btn btn-success w-100">
    ➕ Add Event
</button>

</form>

</div>

</div>

<!-- 🔥 AUTO TRANSLATION SCRIPT -->
<script>
async function translateText() {

    let text = document.getElementById("event_name").value;
    let desc = document.getElementById("description").value;

    if (text.length < 2) return;

    // Hindi
    fetch("https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=hi&dt=t&q=" + text)
    .then(res => res.json())
    .then(data => {
        document.getElementById("event_name_hi").value = data[0][0][0];
    });

    fetch("https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=hi&dt=t&q=" + desc)
    .then(res => res.json())
    .then(data => {
        document.getElementById("description_hi").value = data[0][0][0];
    });

    // Kannada
    fetch("https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=kn&dt=t&q=" + text)
    .then(res => res.json())
    .then(data => {
        document.getElementById("event_name_kn").value = data[0][0][0];
    });

    fetch("https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=kn&dt=t&q=" + desc)
    .then(res => res.json())
    .then(data => {
        document.getElementById("description_kn").value = data[0][0][0];
    });
}
</script>

</body>
</html>