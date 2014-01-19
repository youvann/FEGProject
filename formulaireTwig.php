<?php

require_once 'config/config.php';

if (!isset($_GET['action'])) {
    $action = "formCandidat";
} else {
    $action = $_GET['action'];
}

$limitDate = "7 juin 2014";

switch ($action) {
    case "formCandidat": {
        echo $twig->render('formulaire/formCandidat.html.twig', array(
            "titre2" => "Formation souhaitée"
        ));
    } break;
    case "infoPerso": {
        echo $twig->render('formulaire/infoPerso.html.twig', array(
            "titre2" => "Informations pesonnelles",
            "limitDate" => $limitDate
        ));
    } break;
    case "postBac": {
        echo $twig->render('formulaire/postBac.html.twig', array(
            "titre2" => "Informations post-bac"
        ));
    } break;
    case "choixSpe": {
        echo $twig->render('formulaire/choixSpe.html.twig', array(
            "titre2" => "Choix de la spécialité"
        ));
    } break;
    default: break;
}

