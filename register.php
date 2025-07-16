<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];


    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    $db = db_connect();


    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        die("Username already exists.");
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insert = $db->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $insert->execute([$username, $hashed_password]);

    echo "Registration successful. <a href='login.php'>Login</a>";
    exit();
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Register</title>
    </head>
    <body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    </body>
    </html>