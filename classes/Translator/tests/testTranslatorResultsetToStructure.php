<?php

$structure = array(
	array("i123", "Nom", "TextBox"),
	array("i234", "Prénom", "TextBox"),
	array("i345", "Travaille en plus des études", "CheckBox"),
	array("i456", "Décrivez-vous", "TextArea"),
	array("i567", "Compétences", "CheckBoxGroup", array("Php", "Java", "Sql")),
	array("i678", "Système d'exploitation", "RadioButtonGroup", array("Windows", "Linux", "Mac OS X"))
);


// Connexion PDO
$dbname = 'fegtest1';
$host = 'localhost';
$user = 'root';
$password = '';

static $conn = null;

try {
	$conn = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

$conn->query("SET CHARACTER SET utf8");

$rs = $conn->query('SELECT `information`.`id` as idInfo, `information`.`libelle` as libelleInfo, `type`.`id` as typeInfo, `choix`.`texte` as libellesInfo
			FROM `information` 
			INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
			LEFT JOIN `choix` ON (`information`.`id` = `choix`.`information`)
			WHERE `information`.`code_formation` = \'3BAS\'
			ORDER BY `information`.`id`, `information`.`ordre`;')->fetchAll();
var_dump($rs);
$structureTest = array();

$i = 0;
while ($i < count($rs)) {
	$array = array();
	$array[] = $rs[$i]['idInfo'];
	$array[] = $rs[$i]['libelleInfo'];
	$array[] = $rs[$i]['typeInfo'];
	if ($rs[$i]['typeInfo'] == 'CheckBoxGroup' || $rs[$i]['typeInfo'] == 'RadioButtonGroup') {
		$idInfo = $rs[$i]['idInfo'];
		$libellesInfo = array();
		while ($i < count($rs) && $rs[$i]['idInfo'] === $idInfo) {
			$libellesInfo[] = $rs[$i]['libellesInfo'];
			++$i;
		}
		$array[] = $libellesInfo;
		$i = $i - 1;
	}
	++$i;
	$structureTest[] = $array;
}

var_dump($structureTest);
