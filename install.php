<?php

require 'config.php';

/*
 Acquire db connection
*/

$db = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT, DB_USER, DB_PASS);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/*
 Create DB
*/
$db->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME);

$db->exec('USE '. DB_NAME);


/*
 Create tables
*/
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


/*
 Seed users table
*/
$pass = bin2hex(random_bytes(5));
$hash = password_hash($pass, PASSWORD_BCRYPT);

$db->exec("INSERT INTO `users` (`username`, `password`) VALUES ('admin', '$hash')");


/*
 Seed products table
*/
$seedProducts = function(string $image, string $title, string $description) use (&$db){
    $db->exec("INSERT INTO `products` (`image`, `title`, `description`) VALUES ('$image', '$title', '$description')");
};

$seedProducts('lemon.jpg', 'Lemon', 
'The lemon, Citrus limon Osbeck, is a species of small evergreen tree in the flowering plant family Rutaceae, native to South Asia, primarily North eastern India');

$seedProducts('grape.jpg', 'Grapefruit', 
'The grapefruit is a subtropical citrus tree known for its relatively large sour to semi-sweet, somewhat bitter fruit.');

$seedProducts('orangelo.jpg', 'Orangelo', 
'An orangelo is a hybrid citrus fruit believed to have originated in Puerto Rico. The fruit, a cross between a grapefruit and an orange.');

$seedProducts('oroblanco.jpg', 'Oroblanco', 
'An oroblanco, oro blanco or sweetie is a sweet seedless citrus hybrid fruit similar to grapefruit.');

$seedProducts('tangelo.jpg', 'Tangelo', 
'The tangelo, Citrus × tangelo, is a citrus fruit hybrid of a Citrus reticulata variety such as mandarin orange or a tangerine, and Citrus maxima variety, such as a pomelo or grapefruit.');

$seedProducts('kumquat.jpg', 'Kumquat', 
'Kumquats are a group of small fruit-bearing trees in the flowering plant family Rutaceae');

$seedProducts('pomelo.jpg', 'Pomelo', 
'The pomelo, shaddock, or in scientific terms Citrus maxima or Citrus grandis, is the largest citrus fruit from the family Rutaceae.');

$seedProducts('yuzu.jpg', 'Yuzu', 
'Yuzu is a citrus fruit and plant in the family Rutaceae. It is believed to have originated in central China as a hybrid of mandarin orange and the ichang papeda.');

$seedProducts('mandarin.jpg', 'Mandarin orange', 
'The mandarin orange, also known as the mandarin or mandarine, is a small citrus tree with fruit resembling other oranges, usually eaten plain or in fruit salads.');


/*
 Seed comments table
*/

$seedComments = function(string $name, string $email, string $body, int $approved) use (&$db){
    $db->exec("INSERT INTO `comments` (`name`, `email`, `body`, `approved`) VALUES ('$name', '$email', '$body', '$approved')");
};

$seedComments('CitrusLover123', 'ctroos@citrus.com', 'Nice citruses you got there! :)', 1);

$seedComments('CitrusHater321', 'ctroos@citrus.com', 'Booooo!!!!!', 0);


/*
 Display success messages
*/
echo '<h1>Success</h1>';
echo '<p><strong>DB: </strong>' . DB_NAME . '</p>';
echo '<p><strong>Username:</strong> admin</p>';
echo "<p><strong>Password:</strong> $pass</p>";