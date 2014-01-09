<?php

require_once 'config/config.php';

echo $twig->render('testTwig.html.twig', array(
	'toto' => 'youhou'
));
