<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FEGProject</title>
		<link rel="stylesheet" href="./css/bootstrap.css" />
		<link rel="stylesheet" href="./js/jqueryFileTree/jqueryFileTree.css" />
		<link rel="stylesheet" href="./css/feg.css" />
    </head>

    <body>
		<div class="container">
			<div class="jumbotron">
				<h1>Inscription pour l'année scolaire 2013-2014</h1>
				<p class="text-muted">Bootstrap For Life</p>
			</div><!-- jumbotron -->
			
			<div class="row">
        		<div class=".col-md-8">	

        			<!-- Explorateur de fichier test -->
					<div class="panel panel-primary">
						<div class="panel-body">
							<div id="explorateur"></div>
						</div>
					</div>
					<div id="formation"><?php include('views/form.formation.php'); ?></div>
					<div id="infoPerso"><?php include('views/form.infoPerso.php'); ?></div>
					<div id="choixSpe"><?php include('views/form.choixSpe.php'); ?></div>
					<div id="cursAnt"><?php include('views/form.cursAnt.php'); ?></div>
				
				</div><!-- .col-md-8 -->
			</div><!-- /row -->
		
		</div><!-- container -->
	
		<script type="text/javascript" src="./js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/jquery-form-validator/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="./js/jqueryFileTree/jqueryFileTree.js"></script>
		<script type="text/javascript" src="./js/feg.js"></script>
		<script>
			$('#explorateur').fileTree({
		        // root : ne pas oublier de mettre slash à la fin du chemin !
		        root : "<?php echo str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))); ?>/",
		        script : './js/jqueryFileTree/connectors/jqueryFileTree.php'
		    }, function(file) { 
		        // alert(file);
		        window.open(file.replace("Applications/MAMP/htdocs/", ""));
		    });
		</script>
    </body>
</html>
