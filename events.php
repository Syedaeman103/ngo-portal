<?php
session_start();
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Events</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center/cover;
}

.overlay {
    background: rgba(0,0,0,0.7);
    min-height: 100vh;
    padding: 20px;
}

.card {
    border-radius: 15px;
    margin-bottom: 15px;
}

h2 {
    color: white;
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>

<body>

<div class="overlay">

<!-- 🌐 Language Selector -->
<div class="text-end mb-3">
<select id="lang" onchange="changeLang()" class="form-select w-50 ms-auto">
    <option value="en">English</option>
    <option value="hi">Hindi</option>
    <option value="kn">Kannada</option>
</select>
</div>

<h2>📅 Available Events</h2>

<div class="container">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card p-3">

<h5 class="event-name"
    data-en="<?php echo $row['event_name']; ?>"
    data-hi="<?php echo $row['event_name_hi']; ?>"
    data-kn="<?php echo $row['event_name_kn']; ?>">
    <?php echo $row['event_name']; ?>
</h5>

<p class="event-desc"
   data-en="<?php echo $row['description']; ?>"
   data-hi="<?php echo $row['description_hi']; ?>"
   data-kn="<?php echo $row['description_kn']; ?>">
   <?php echo $row['description']; ?>
</p>

<p>📅 <?php echo $row['event_date']; ?></p>
<p>⏰ <?php echo date("h:i A", strtotime($row['event_time'])); ?></p>
<p>📍 <?php echo $row['venue']; ?></p>

<a href="join_event.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-success w-100">
   🤝 Join Event
</a>

</div>

<?php } ?>

</div>

</div>

<!-- 🌐 LANGUAGE SCRIPT -->
<script>
function changeLang() {
    let lang = document.getElementById("lang").value;

    document.querySelectorAll(".event-name").forEach(el => {
        el.innerText = el.getAttribute("data-" + lang);
    });

    document.querySelectorAll(".event-desc").forEach(el => {
        el.innerText = el.getAttribute("data-" + lang);
    });
}
</script>

</body>
</html>