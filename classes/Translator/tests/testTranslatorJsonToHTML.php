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

					$structure = array(
						array("i123", "Nom", "TextBox"),
						array("i234", "Prénom", "TextBox"),
						array("i345", "Travaille en plus des études", "CheckBox"),
						array("i456", "Décrivez-vous", "TextArea"),
						array("i567", "Compétences", "CheckBoxGroup", array("Php", "Java", "Sql")),
						array("i678", "Système d'exploitation", "RadioButtonGroup", array("Windows", "Linux", "Mac OS X")));

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
