<?php

require_once 'config/config.php';

echo $twig->render('formCandidat.html.twig', array(
    'directory' => str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))) . '/',
    'titre2' => 'Inscription pour l\'année scolaire 2014-2015'
));

