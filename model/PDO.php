<?php

// Connexion PDO
$dbname = 'miageaixcandid';
$host = 'localhost';
$user = 'root';
$password = '';
if (__DIR__ !== 'C:\wamp\www\FEGProject\model') {
	$password = 'root';
}
static $conn = null;

try {
	$conn = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

$conn->query("SET CHARACTER SET utf8");
