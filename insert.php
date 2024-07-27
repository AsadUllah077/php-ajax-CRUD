<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-ajax";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$email = $_POST['email'];
$name = $_POST['name'];

if ($conn) {
    echo "INSERT INTO usertable (email,name1) VALUES ('{$email}','{$name}')";
    $res =   mysqli_query($conn, "INSERT INTO usertable (email,name1) VALUES ('{$email}','{$name}')");
    if ($res) {
        echo "Inserted successfully";
    } else {
        echo "not insert successfully";
    }
} else {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_close($conn);
