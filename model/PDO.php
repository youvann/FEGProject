<?php

/*/ Connexion PDO
$dbname = 'fegtest1';
$host = 'localhost';
$user = 'root';
$password = '';*/

// Connexion PDO
$dbname = 'miageaixcandid';
$host = 'mysql51-63.pro';
$user = 'miageaixcandid';
$password = 'candidfeg13';

static $conn = null;

try {
	$conn = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

$conn->query("SET CHARACTER SET utf8");