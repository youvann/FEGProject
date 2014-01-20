<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
    case "grille": {
		$informations = $informationManager->findAllByFormation($_GET['code']);
        echo $twig->render('information/grilleInformation.html.twig', array('informations' => $informations, 'code' => $_GET['code']));
    } break;
    case "ajouter": {
		$types = $typeManager->findAll();
        echo $twig->render('information/ajouterInformation.html.twig', array('types' => $types, 'code' => $_GET['code']));
    } break;
    case "ajout": {
        $informationManager->insert(new Information(0, $_POST["nom"], $_POST["code"], $_POST["libelle"], $_POST["explications"], 0));
        header('location:index.php?uc=information&action=grille&code='.$_POST['code']);
    } break;
    case "modifier": {
        $information = $informationManager->find($_GET['id']);
        echo $twig->render('information/modifierInformation.html.twig', array('information' => $information));
    } break;
    case "modification": {
        //$information = new Information($_POST["id"], $_POST["nom"], $_POST["id"], $_POST["code"], $_POST["libelle"], $_POST["explications"], $_POST["ordre"]));
        $informationManager->update($information);
        header('location:index.php?uc=information&action=grille');
    } break;
    case "suppression": {
        $information = $informationManager->find($_GET['id']);
        $informationManager->delete($information);
        header('location:index.php?uc=information&action=grille');
    } break;
    default: break;
}