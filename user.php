<?php
require_once 'database.php';

class User {

    public function register($username, $password) {
        $dbh = db_connect();


        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->fetch()) {
            return "Username already exists.";
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $dbh->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        return true;
    }




?>