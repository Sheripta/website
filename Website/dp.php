<?php
$servername = "localhost"; // Server name (default is localhost)
$username = "root";        // Default username for XAMPP/WAMP
$password = "";            // Default password is empty
$dbname = "registration";  // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
