<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

function get_safe_value($conn, $value) {
    return mysqli_real_escape_string($conn, trim($value));
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-ajax";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . mysqli_connect_error()]);
    exit;
}

// Get POST data and sanitize
$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);

// Insert data into the database
$sql = "INSERT INTO usertable (name1, email) VALUES ('$name', '$email')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Data Inserted Successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Data not inserted Successfully: " . mysqli_error($conn)]);
}

// Close the connection
mysqli_close($conn);
?>
