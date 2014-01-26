<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Json To HTML</title>
		<link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
		<!--<link rel="stylesheet" href="../../../public/css/bootstrap-theme.min.css" />-->
    </head>
    <body>
		<div class="container">
			<div class="row">
				<div class="page-header">
					<h1>Json To HTML</h1>
				</div>
				<div class="col-md-12">
					<form role="form" method="POST" action="testTranslatorJsonToHTML.php">
						<div class="form-group">
							<label for="json">Json :</label>
							<input class="form-control" type="text" id="json" name="json" />
						</div>
						<input class="btn btn-primary" type="submit" value="Ok" />
					</form>
					<?php
					require_once '../loader.php';

					$json1 = '{"i123":"Meas","i234":"Kevin","i345":"Non","i456":"Fan de PHP","i567":["Oui","Oui","Non"],"i678":"Windows"}';
					$json2 = '[{"i123":"Meas"},{"i234":"Kevin"},{"i345":"Non"},{"i456":"Fan de PHP"},{"i567":["Oui","Non","Non"]},{"i678":"Windows"}]';

					require_once '../../../model/PDO.php';

					$rs = $conn->query('SELECT `information`.`id` as idInfo, `information`.`libelle` as libelleInfo, `type`.`id` as typeInfo, `choix`.`texte` as libellesInfo
FROM `information` 
	INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
	LEFT JOIN `choix` ON (`information`.`id` = `choix`.`texte`) 
	ORDER BY `information`.`ordre`;')->fetchAll();

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


					if (!empty($_POST)) {
						$translator = new TranslatorJsonToHTML();
						echo $translator->translate($_POST['json'], $structure);
					}
					?>
				</div><!-- col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="../../../public/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../public/js/bootstrap.min.js"></script>
    </body>
</html>
