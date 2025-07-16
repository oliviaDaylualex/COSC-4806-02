<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: /login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Assignment 2</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></p>
    <p><a href="/logout.php">Logout</a></p>
</body>
</html>