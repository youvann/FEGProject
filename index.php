<?php
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FEGProject</title>
		<link rel="stylesheet" href="./public/css/bootstrap.css" />
		<link rel="stylesheet" href="./public/js/jqueryFileTree/jqueryFileTree.css" />
		<link rel="stylesheet" href="./public/css/feg.css" />
    </head>

    <body>
		<div class="container">
			<div class="jumbotron">
				<h1>Inscription pour l'année scolaire 2013-2014</h1>
				<p class="text-muted">Bootstrap For Life</p>
				<?php var_dump(str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__)))); ?>
			</div><!-- jumbotron -->

			<div class="row">
				
				<div class="col-md-8">
					<div id="explorateur"></div>
					<br>
					<div id="formation"><?php include('./templates/form.formation.php'); ?></div>
					<div id="infoPerso"><?php include('./templates/form.infoPerso.php'); ?></div>
					<div id="choixSpe"><?php include('./templates/form.choixSpe.php'); ?></div>
					<div id="cursAnt"><?php include('./templates/form.cursAnt.php'); ?></div>

				</div><!-- .col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="./public/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="./public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./public/js/jquery-form-validator/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="./public/js/feg.js"></script>
		<script type="text/javascript" src="./public/js/jqueryFileTree/jqueryFileTree.js"></script>
		<script type="text/javascript">
			$('#explorateur').fileTree({
		        // root : ne pas oublier de mettre slash à la fin du chemin !
		        root : "<?php echo str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))); ?>/",
		        script : './public/js/jqueryFileTree/connectors/jqueryFileTree.php'
		    }, function(file) {
		        // alert(file);
		        window.open(file.replace("Applications/MAMP/htdocs/", ""));
		    });
		</script>
    </body>
</html>
