<?php
include_once '../includes/db.php';
session_start();


$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id,username,role FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user;
    $con->close();
    header('Location: ../index.php');
} else {
    $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu";
    $con->close();
    header("Location: ../login.php");
}
