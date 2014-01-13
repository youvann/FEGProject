<?php

$structure = array(
	array("i123", "Nom", "TextBox"),
	array("i234", "Prénom", "TextBox"),
	array("i345", "Travaille en plus des études", "CheckBox"),
	array("i456", "Décrivez-vous", "TextArea"),
	array("i567", "Compétences", "CheckBoxGroup", array("Php", "Java", "Sql")),
	array("i678", "Système d'exploitation", "RadioButtonGroup", array("Windows", "Linux", "Mac OS X"))
);

require_once '../../../model/PDO.php';

$rs = $conn->query('SELECT `information_supp`.`id` as idInfo, `information_supp`.`libelle` as libelleInfo, `type_formelement`.`nom` as typeInfo, `libelle_info`.`contenu` as libellesInfo
FROM `information_supp` 
	INNER JOIN `type_formelement` ON (`information_supp`.`type` = `type_formelement`.`id`)
	LEFT JOIN `libelle_info` ON (`information_supp`.`id` = `libelle_info`.`info`) 
	ORDER BY `information_supp`.`ordre`;')->fetchAll();

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
