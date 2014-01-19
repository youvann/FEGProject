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
        $informationsSupp = array();
        $informationsSupp[] = new InformationSupp("code_etape", "code_vet", "id", "libel_info", "requis", "idTypeElement");
        $informationsSupp[] = new InformationSupp("code_etape2", "code_vet2", "id2", "libel_info2", "requis2", "idTypeElement2");
        echo $twig->render('informationSupp/grilleInformationSupp.html.twig', array('informationsSupp' => $informationsSupp, "titre2" => "Liste des informations supplémentaires"));
    } break;
    case "ajouter": {
        echo $twig->render('informationSupp/ajouterInformationSupp.html.twig', array('titre2' => 'Ajouter une information suppélementaire'));
    } break;
    case "ajout": {
        $informationSuppManager->insert(new InformationSupp($_POST["code_etape"], $_POST["code_vet"], $_POST["id"], $_POST["libel_information"], $_POST["requis"], $_POST["id_type_element"]));
        header('location:index.php?uc=informationSupp&action=grille');
    } break;
    case "modifier": {
        $informationSupp = $informationSuppManager->find($_GET['code_etape'], $_GET['code_vet'], $_POST["id"]);
        echo $twig->render('informationSupp/modifierInformationSupp.html.twig', array('informationSupp' => $informationSupp));
    } break;
    case "modification": {
        $informationSupp = new InformationSupp($_POST["code_etape"], $_POST["code_vet"], $_POST["id"], $_POST["libel_information"], $_POST["requis"], $_POST["id_type_element"]);
        $informationSuppManager->update($informationSupp);
        header('location:index.php?uc=informationSupp&action=grille');
    } break;
    case "suppression": {
        $informationSupp = $informationSuppManager->find($_GET['code_etape'], $_GET['code_vet'], $_POST["id"]);
        $informationSuppManager->delete($informationSupp);
        header('location:index.php?uc=informationSupp&action=grille');
    } break;
    default: break;
}