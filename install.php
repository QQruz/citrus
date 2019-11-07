<?php

require 'config.php';

$db = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT, DB_USER, DB_PASS);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME);

$db->exec('USE '. DB_NAME);

$db->exec("CREATE TABLE IF NOT EXISTS `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `image` VARCHAR(2048),
    `title` VARCHAR(50),
    `description` VARCHAR(100)
)");

$db->exec("CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(30),
    `email` VARCHAR(320),
    `body` VARCHAR(255),
    `approved` BOOLEAN DEFAULT false
)");

$db->exec("CREATE TABLE IF NOT EXISTS `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(30) UNIQUE,
    `password` VARCHAR(60)
    )");

$pass = bin2hex(random_bytes(5));
$hash = password_hash($pass, PASSWORD_BCRYPT);

$db->exec("INSERT INTO `users` (`username`, `password`) VALUES ('admin', '$hash')");

echo '<h1>Success</h1>';
echo '<p><strong>DB: </strong>' . DB_NAME . '</p>';
echo '<p><strong>Username:</strong> admin</p>';
echo "<p><strong>Password:</strong> $pass</p>";