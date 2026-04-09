<?php
session_start();
include "config.php";

// 🔐 Only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6') no-repeat center center/cover;
        }

        .overlay {
            background: rgba(0,0,0,0.6);
            min-height: 100vh;
            padding: 40px 0;
        }

        h2 {
            text-align: center;
            color: white;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        /* User Card */
        .user-card {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: 0.3s;
        }

        .user-card:hover {
            transform: scale(1.03);
        }

        /* Different Colors */
        .bg1 { background: linear-gradient(45deg, #16a34a, #4ade80); }
        .bg2 { background: linear-gradient(45deg, #0ea5e9, #38bdf8); }
        .bg3 { background: linear-gradient(45deg, #9333ea, #c084fc); }
        .bg4 { background: linear-gradient(45deg, #f59e0b, #fbbf24); }

        .user-name {
            font-size: 20px;
            font-weight: bold;
        }

        .user-email {
            font-size: 14px;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="overlay">
    <div class="container">

        <h2><i class="fas fa-users"></i> All Users</h2>

        <?php 
        $colors = ['bg1', 'bg2', 'bg3', 'bg4'];
        $i = 0;

        while($row = mysqli_fetch_assoc($result)) {
            $class = $colors[$i % 4];
            $i++;
        ?>

            <div class="user-card <?php echo $class; ?>">

                <div class="user-name">
                    <i class="fas fa-user"></i>
                    <?php echo $row['name']; ?>
                </div>

                <div class="user-email">
                    <i class="fas fa-envelope"></i>
                    <?php echo $row['email']; ?>
                </div>

            </div>

        <?php } ?>

        <div class="text-center">
            <a href="dashboard_admin.php" class="btn btn-success btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

    </div>
</div>

</body>
</html>