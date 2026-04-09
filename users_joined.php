<?php
session_start();
include "config.php";

$result = mysqli_query($conn,
"SELECT users.name, events.event_name 
 FROM event_registrations
 JOIN users ON users.id = event_registrations.user_id
 JOIN events ON events.id = event_registrations.event_id");
?>

<h2>Joined Users</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <p><?php echo $row['name']; ?> joined <?php echo $row['event_name']; ?></p>
<?php } ?>