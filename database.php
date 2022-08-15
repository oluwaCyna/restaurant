<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "restaurant";
if (!$db = mysqli_connect($hostname, $username, $password, $database)) {
    echo "Not connected";
}
