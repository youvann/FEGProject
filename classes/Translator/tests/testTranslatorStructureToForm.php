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

					$rs = $conn->query("SELECT `information`.`ID` as idInfo, `information`.`LIBELLE` as libelleInfo, `type`.`ID` as typeInfo, `choix`.`TEXTE` as libellesInfo
						FROM `information`
							INNER JOIN `type` ON (`information`.`TYPE` = `type`.`ID`)
							LEFT JOIN `choix` ON (`information`.`ID` = `choix`.`INFORMATION`)
						WHERE `information`.`DOSSIER_PDF` = 2
						ORDER BY `information`.`ORDRE`;")->fetchAll();

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
			</div><!-- row -->
		</div><!-- container -->

		<script type="text/javascript" src="../../../public/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../public/js/bootstrap.min.js"></script>
    </body>
</html>
