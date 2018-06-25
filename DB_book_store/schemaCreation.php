<?php
$servername = "localhost";
$username = "root";
$password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Create book_store database
    $sqlCreateSchema = "CREATE DATABASE IF NOT EXISTS book_store;";
try {
    $conn->query($sqlCreateSchema);
} catch (Exception $e) {
    echo 'Creating book_store Has Failed: '.$e->getMessage();
    exit;
}
// Create books Table
$sqlCreateBooksTable = "CREATE TABLE `book_store`.`books` (
        `book_id` INT NOT NULL AUTO_INCREMENT,
        `book_name` VARCHAR(64) NULL,
        `author` VARCHAR(32) NULL,
        `price` DOUBLE NULL DEFAULT 0.0,
        PRIMARY KEY (`book_id`));";
try {
    $conn->query($sqlCreateBooksTable);
} catch (Exception $e) {
    echo 'Creating Books Table Has Failed: '.$e->getMessage();
    exit;
}
// Create users Table
$sqlCreateUsersTable = "CREATE TABLE `book_store`.`users` (
        `user_id` INT NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(16) NOT NULL,
        `password` VARCHAR(24) NOT NULL,
        `email` VARCHAR(40) NOT NULL,
        PRIMARY KEY (`user_id`));";
try {
    $conn->query($sqlCreateUsersTable);
} catch (Exception $e) {
    echo 'Creating Books Table Has Failed: '.$e->getMessage();
    exit;
}
$conn->close();