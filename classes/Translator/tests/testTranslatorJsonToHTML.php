<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FEGProject</title>
		<link rel="stylesheet" href="../../../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../../css/bootstrap-theme.min.css" />
    </head>

    <body>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php
					require_once '../loader.php';
					// Faire gaffe aux true et false entoures ou non de guillemets pour passer du php a json et inversement
					$translator = new TranslatorJsonToHTML();
					$translator->translate('{"i123":"Meas","i234":"Kevin","i345":"false","i456":"Fan de PHP","i567":["true","true","false"],"i678":"Windows"}', array(
						array("i123", "Nom", "TextBox"),
						array("i234", "Prénom", "TextBox"),
						array("i345", "Travaille en plus des études", "CheckBox"),
						array("i456", "Décrivez-vous", "TextArea"),
						array("i567", "Compétences", "CheckBoxGroup", array("Php", "Java", "Sql")),
						array("i678", "Système d'exploitation", "RadioButtonGroup", array("Windows", "Linux", "Mac OS X"))));
					?>
				</div><!-- col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="../../../js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../js/bootstrap.min.js"></script>
    </body>
</html>
