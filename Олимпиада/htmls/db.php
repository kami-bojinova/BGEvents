<?php
$servername = "localhost";
$username = "kvbbgcom_BGEvents";
$password = "BGEvents!";
$database = "kvbbgcom_bgevents";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
mysqli_report(MYSQLI_REPORT_OFF);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
