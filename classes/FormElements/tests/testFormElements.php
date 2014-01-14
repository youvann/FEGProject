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
			<div class="row">
				<div class="col-md-8">
					<?php
					var_dump($_POST);
					var_dump(json_encode($_POST));
					
					$infos = array(array("Nom","TextBox"),
								array("Prénom","TextBox"),
								array("Travaille en plus des études","CheckBox"),
								array("Décrivez-vous","TextArea"),
								array("Compétences","CheckBoxGroup",array("Php","Java","Sql"))
							);
					
					require_once 'classes/FormElements/mainLoader.php';
					$form = new Form("POST", "testFormElements.php");

					// Textboxes
					$tb1 = new TextBox("tbn", "tbn", "");
					$tb1->setLabel(new Label("tbn", "Nom :"));
					$tb2 = new TextBox("tbp", "tbp", "");
					$tb2->setLabel(new Label("tbp", "Prénom :"));
					
					// CheckBox
					$cb1 = new CheckBox("cbt", "cbt", "travail");
					$cb1->setLabel(new Label("cbt", "Travaillez vous à côté des études ?"));
					
					// TextArea
					$ta1 = new TextArea("tad", "tad", "");
					$ta1->setLabel(new Label("ta1", "Décrivez-vous :"));
					
					// CheckBoxGroup
					$cbg1 = new CheckBoxGroup();
					$cbg1->setLabel(new Label("", "Compétences"));
					$cbgi1 = new CheckBox("cbgi1", "cbgi[]", "php");
					$cbgi1->setLabel(new Label("cbgi1", "Php"));
					$cbgi2 = new CheckBox("cbgi2", "cbgi[]", "java");
					$cbgi2->setLabel(new Label("cbgi2", "Java"));
					$cbgi3 = new CheckBox("cbgi3", "cbgi[]", "sql");
					$cbgi3->setLabel(new Label("cbgi3", "Sql"));
					$cbg1->addCheckBox($cbgi1);
					$cbg1->addCheckBox($cbgi2);
					$cbg1->addCheckBox($cbgi3);
					
					// RadioButtonGroup
					$rbg1 = new RadioButtonGroup();
					$rbg1->setLabel(new Label("", "Système d'exploitation"));
					$rbgi1 = new RadioButton("rbgi1", "rbg1", "Windows");
					$rbgi1->setLabel(new Label("rbgi1", "Windows"));
					$rbgi2 = new RadioButton("rbgi2", "rbg1", "Linux");
					$rbgi2->setLabel(new Label("rbgi2", "Linux"));
					$rbgi3 = new RadioButton("rbgi2", "rbg1", "Mac");
					$rbgi3->setLabel(new Label("rbgi2", "Mas OS X"));
					$rbg1->addRadioButton($rbgi1);
					$rbg1->addRadioButton($rbgi2);
					$rbg1->addRadioButton($rbgi3);
					
					$form->addFormElement($tb1);
					$form->addFormElement($tb2);
					$form->addFormElement($cb1);
					$form->addFormElement($ta1);
					$form->addFormElement($cbg1);
					$form->addFormElement($rbg1);
					
					echo $form;
					?>
				</div><!-- col-md-8 -->
			</div><!-- /row -->
		</div><!-- container -->

		<script type="text/javascript" src="./js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/jquery-form-validator/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="./js/feg.js"></script>
    </body>
</html>
