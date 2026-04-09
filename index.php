<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EnviroPortal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🌱 EnviroPortal</a>
    </div>
</nav>

<!-- HERO SECTION -->
<div class="hero-section text-center text-white d-flex align-items-center">
    <div class="container">

        <h1 class="display-5 fw-bold mb-3">
            Welcome to the Environmental Volunteers Portal
        </h1>

        <p class="lead fw-bold tagline">
            Connect with NGOs, join environmental projects, and make a difference 🌍
        </p>

        <div class="mt-4">
            <a href="register.php" class="btn btn-primary btn-lg me-2">Register</a>
            <a href="login.php" class="btn btn-success btn-lg">Login</a>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="text-center text-white py-3">
    © <?php echo date('Y'); ?> EnviroPortal. All rights reserved.
</footer>

</body>
</html>