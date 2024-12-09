<?php
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?controller=auth&action=login");
    exit();
}

// Get the username
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solar System</title>
        <link rel="stylesheet" href="../../public/css/solar_system.css">
    </head>
    <body>
        <div class="banner">
            <video autoplay loop muted plays-inline>
                <source src="../../public/videos/video.mp4" type="video/mp4">
            </video>
            <div class="navbar">
                <ul>
                    <li><a href="solar_system.php"><button class="button">HOME</button></a></li>
                    <li><a href="https://www.nasa.gov" target="_blank"><button class="button">NASA</button></a></li>
                    <li><a href="https://eyes.nasa.gov/apps/solar-system/#/home" target="_blank"><button class="button">3D SIMULATION</button></a></li>
                    <li><a href="about.php"><button class="button">ABOUT</button></a></li>
                    <li><a href="auth/logout.php"><button class="button">LOGOUT</button></a></li>
                </ul>
            </div>
            <div class="content">
                <h1>WELCOME TO OUR SOLAR SYSTEM, <?php echo strtoupper(htmlspecialchars($_SESSION['username'])); ?>!</h1>
                <div>
                    <button type="button" class="btn">
                        <a href="#" onclick="explore()">EXPLORE</a>
                    </button>                    
                </div>
            </div>
        </div>
        <script>
            function explore() {
                // You can add exploration functionality here
                alert("Let's explore the solar system!");
            }
        </script>
    </body>
</html>
