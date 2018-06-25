<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

$conn = new mysqli($servername, $username, $password , $dbname);

$GLOBALS['connection'] = $conn;
