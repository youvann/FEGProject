<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form To Json</title>
		<link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
		<!--<link rel="stylesheet" href="../../../public/css/bootstrap-theme.min.css" />-->
    </head>

    <body>
		<div class="container">
			<div class="page-header">
				<h1>Form To Json</h1>
			</div>
			<div class="row">
				<div class="col-md-8">
					<?php
					require_once '../loader.php';

					require_once '../../../model/PDO.php';

					$rs = $conn->query("SELECT `information`.`id` as idInfo, `information`.`libelle` as libelleInfo, `type`.`id` as typeInfo, `choix`.`texte` as libellesInfo
						FROM `information` 
							INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
							LEFT JOIN `choix` ON (`information`.`id` = `choix`.`information`) 
						WHERE `information`.`code_formation` = '3BAS'
						ORDER BY `information`.`ordre`;")->fetchAll();

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

					var_dump($structure, $_POST);
					if (!empty($_POST)) {
						$translator = new TranslatorFormToJson();
						var_dump($translator->translate($structure, $_POST));
					}

					// Faire gaffe aux true et false entoures ou non de guillemets pour passer du php a json et inversement
					// $translator = new TranslatorStructureToForm();
					// $translator->translate();
					?>
					<a class="btn btn-primary" href="testTranslatorStructureToForm.php">Retour</a>
				</div><!-- col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="../../../js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../js/bootstrap.min.js"></script>
    </body>
</html>
