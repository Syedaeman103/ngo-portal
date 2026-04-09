<?php
session_start();
include "config.php";
include "language.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Join logic
if (isset($_GET['join'])) {
    $event_id = intval($_GET['join']);

    $check = mysqli_query($conn, "SELECT * FROM event_registrations WHERE user_id=$user_id AND event_id=$event_id");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO event_registrations (user_id, event_id) VALUES ($user_id, $event_id)");
        echo "<script>alert('Joined Successfully!');</script>";
    } else {
        echo "<script>alert('Already Joined!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $lang['join_events']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center/cover;
        }

        .overlay {
            background: rgba(0,0,0,0.7);
            min-height: 100vh;
            padding: 40px;
        }

        .event-box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .btn-join {
            background: green;
            color: white;
        }

        .lang {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>

<!-- 🌍 Language Switch -->
<div class="lang">
    <a href="?lang=en" class="btn btn-light btn-sm">EN</a>
    <a href="?lang=hi" class="btn btn-warning btn-sm">HI</a>
    <a href="?lang=kn" class="btn btn-success btn-sm">KN</a>
</div>

<div class="overlay">
<div class="container">

<h2 class="text-white text-center">
    🌿 <?php echo $lang['available_events']; ?>
</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM events");

if (mysqli_num_rows($result) == 0) {
    echo "<h4 class='text-white text-center'>" . $lang['no_events'] . "</h4>";
}

while ($row = mysqli_fetch_assoc($result)) {

// 🌍 MULTILANGUAGE LOGIC
$event_name = $row['event_name'];
$description = $row['description'];

if ($_SESSION['lang'] == 'hi') {
    if (!empty($row['event_name_hi'])) $event_name = $row['event_name_hi'];
    if (!empty($row['description_hi'])) $description = $row['description_hi'];
}

if ($_SESSION['lang'] == 'kn') {
    if (!empty($row['event_name_kn'])) $event_name = $row['event_name_kn'];
    if (!empty($row['description_kn'])) $description = $row['description_kn'];
}
?>

<div class="event-box">
    <h4><?php echo $event_name; ?></h4>
    <p><?php echo $description; ?></p>

    <p><b><?php echo $lang['date']; ?>:</b> <?php echo $row['event_date']; ?></p>

    <a href="join_event.php?join=<?php echo $row['id']; ?>" class="btn btn-join">
        <?php echo $lang['join_event']; ?>
    </a>
</div>

<?php } ?>

<div class="text-center mt-3">
    <a href="dashboard_user.php" class="btn btn-primary">
        ⬅ <?php echo $lang['back']; ?>
    </a>
</div>

</div>
</div>

</body>
</html>