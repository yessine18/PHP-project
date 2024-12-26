<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the username, default to 'Guest' if not set
$username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solar System</title>
        <link rel="stylesheet" href="../inc/css/landing.css">
    </head>
    <body>
        <div class="banner">
            <video autoplay loop muted plays-inline>
                <source src="../../inc/ressources/videoBackground.mp4" type="video/mp4">
            </video>
            <div class="navbar">
                <ul>
                    <li><a href="index.php?page=solar_system"><button class="button">HOME</button></a></li>
                    <li><a href="https://www.nasa.gov" target="_blank"><button class="button">NASA</button></a></li>
                    <li><a href="https://eyes.nasa.gov/apps/solar-system/#/home" target="_blank"><button class="button">3D SIMULATION</button></a></li>
                    <li><a href="about.php"><button class="button">ABOUT</button></a></li>
                    <li><a href="index.php?page=logout"><button class="button">LOGOUT</button></a></li>
                </ul>
            </div>
        <div class="content">
            <h1>WELCOME TO OUR SOLAR SYSTEM, <?php echo strtoupper(htmlspecialchars($username)); ?>!</h1>
            <div>
                    <button type="button" class="btn">
                        <a href="index.php?page=explore">EXPLORE</a>
                    </button>                  
            </div>
        </div>
    </div>
</body>
</html>
