<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Structure To Form</title>
		<link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
		<!--<link rel="stylesheet" href="../../../public/css/bootstrap-theme.min.css" />-->
    </head>
    <body>
		<div class="container">
			<div class="page-header"><h1>Structure To Form</h1></div>
			<div class="row">
				<div class="col-md-12">
					<?php
					require_once '../../FormElements/loader.php';
					require_once '../loader.php';

					require_once '../../../model/PDO.php';

					$rs = $conn->query('SELECT `information_supp`.`id` as idInfo, `information_supp`.`libelle` as libelleInfo, `type_formelement`.`nom` as typeInfo, `libelle_info`.`contenu` as libellesInfo
FROM `information_supp` 
	INNER JOIN `type_formelement` ON (`information_supp`.`type` = `type_formelement`.`id`)
	LEFT JOIN `libelle_info` ON (`information_supp`.`id` = `libelle_info`.`info`) 
	ORDER BY `information_supp`.`ordre`;')->fetchAll();

					$structure = array();

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
						$structure[] = $array;
					}



					// Faire gaffe aux true et false entoures ou non de guillemets pour passer du php a json et inversement
					$translator = new TranslatorStructureToForm();
					echo $translator->translate($structure);
					?>
				</div><!-- col-md-12 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="../../../public/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../public/js/bootstrap.min.js"></script>
    </body>
</html>
