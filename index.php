<?php
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FEGProject</title>
		<link rel="stylesheet" href="./css/bootstrap.min.css" />
		<link rel="stylesheet" href="./css/bootstrap-theme.min.css" />
		<link rel="stylesheet" href="./css/feg.css" />
    </head>

    <body>
		<div class="container">
			<div class="jumbotron">
				<h1>Inscription pour l'année scolaire 2013-2014</h1>
				<p class="text-muted">Bootstrap For Life</p>
			</div><!-- jumbotron -->

			<div class="row">
				<div class="col-md-8">

					<div id="formation"><?php include('./templates/form.formation.php'); ?></div>
					<div id="infoPerso"><?php include('./templates/form.infoPerso.php'); ?></div>
					<div id="choixSpe"><?php include('./templates/form.choixSpe.php'); ?></div>
					<div id="cursAnt"><?php include('./templates/form.cursAnt.php'); ?></div>

				</div><!-- .col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="./js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/jquery-form-validator/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="./js/feg.js"></script>
    </body>
</html>
