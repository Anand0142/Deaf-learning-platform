<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "login";

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Failed to connect to database: " . $conn->connect_error);
}

$quiz_results_db = $conn;
if ($quiz_results_db->connect_error) {
    echo "Failed to connect to Quiz Results DB: " . $quiz_results_db->connect_error;
    exit();
}
?>