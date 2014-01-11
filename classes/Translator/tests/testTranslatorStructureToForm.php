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
					
					$structure = array(
							array("i123", "Nom", "TextBox"),
							array("i234", "Prénom", "TextBox"),
							array("i345", "Travaille en plus des études", "CheckBox"),
							array("i456", "Décrivez-vous", "TextArea"),
							array("i567", "Compétences", "CheckBoxGroup", array("Php", "Java", "Sql")),
							array("i678", "Système d'exploitation", "RadioButtonGroup", array("Windows", "Linux", "Mac OS X"))
						);
					
					
					
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
