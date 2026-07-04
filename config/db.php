<?php
$host = 'hayabusa.proxy.rlwy.net';
$port = 59133;
$user = 'root';
$password = 'gHzvGrVDvMXkGTAXqWrAqkZZfSxdOWaN';
$dbname = 'easytrip';

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>