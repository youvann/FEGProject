<?php

require_once 'config/config.php';

echo $twig->render('explorateur.html.twig', array(
	'directory' => str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))) . '/'
));
