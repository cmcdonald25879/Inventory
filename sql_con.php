<?php
$servername = "localhost";
$username = "RCON";
$password = "ApacheServer";
$dbname = "DEVELOPMENTGROUP";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
}
?>
