<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Process and store the data securely
    echo "Thank you, $first_name! Your registration was successful.";
}
?>
