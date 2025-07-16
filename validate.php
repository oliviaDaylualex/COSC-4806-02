<?php
session_start();
require_once('database.php');

$username = $_POST['username'];
$password = $_POST['password'];

$db = db_connect();
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    exit();
} else {
    echo "Invalid login. <a href='login.php'>Try again</a>";
}
?>