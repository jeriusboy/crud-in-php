<?php

$servername = "localhost";  
$username = "root";
$password = "";
$database = "test";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (!empty($id)) {
    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        
    }
}


?>