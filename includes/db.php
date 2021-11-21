<?php
header("Content-type: text/html; charset=utf-8");
$serverName = "192.168.10.10";
$username = "homestead";
$password = "secret";
$db = "web_ptit";

$con = mysqli_connect($serverName, $username, $password, $db);
mysqli_set_charset($con, 'UTF8');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
