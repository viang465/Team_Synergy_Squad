<?php
$servername = "localhost";
$username = "root";
$password = ""; // your MySQL password
$dbname = "avianna_resort";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>