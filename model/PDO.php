<?php

// PDO
$dbname = 'test';
$host = 'localhost';
$user = 'root';
$password = '';


static $conn = null;

try {
	$conn = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $password);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

$conn->query("SET CHARACTER SET utf8");