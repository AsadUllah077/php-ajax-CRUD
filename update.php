<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-ajax";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$email = $_POST['email'];
$name = $_POST['name'];
$id = $_POST['id'];

// Function to sanitize input data
function get_safe_value($conn, $value) {
    return mysqli_real_escape_string($conn, trim($value));
}

$email = get_safe_value($conn, $email);
$name = get_safe_value($conn, $name);
$id = get_safe_value($conn, $id);

if ($conn) {
    $res = mysqli_query($conn, "UPDATE usertable SET email='$email', name1='$name' WHERE id='$id'");
    if ($res) {
        echo "Update successfully";
    } else {
        echo "Not successfully";
    }
} else {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_close($conn);
?>
