<?php
$password = "JIJI123"; // Replace with the password you want to use
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Original password: " . $password . "\n";
echo "Hashed password: " . $hashed_password . "\n";

// Verify the hash works
if (password_verify($password, $hashed_password)) {
    echo "Hash verification successful!\n";
} else {
    echo "Hash verification failed!\n";
}

// Try verifying with the stored hash from your database
$stored_hash = '$2y$10$74jwo/K21ZNlmP3LifGeoOaqUGY.AbRRpdK4RxXA22FCwZLW3WZVq';
if (password_verify($password, $stored_hash)) {
    echo "Stored hash verification successful!\n";
} else {
    echo "Stored hash verification failed!\n";
}
