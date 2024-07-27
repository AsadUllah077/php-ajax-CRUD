<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php-ajax";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        $id =$_POST['id'];
        if ($id){
              mysqli_query($conn,"Delete from `usertable` where id='$id'");
              echo "Deleted successfully";
        }else{
            echo "Doesn't Deleted ";
        }
    }
?>