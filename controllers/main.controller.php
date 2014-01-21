<?php

/**
 * @Project: FEG Project
 * @File: /controllers/main.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['uc'])) {
    $uc = "formation";
} else {
    $uc = $_GET['uc'];
}

/* / autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($uc) {
    case "formation": {
        require_once './controllers/formation.controller.php';
    } break;
    case "documentSpecifique": {
        require_once './controllers/documentSpecifique.controller.php';
    } break;
    case "document": {
        require_once './controllers/document.controller.php';
    } break;
    case "information": {
        require_once './controllers/information.controller.php';
    } break;
    case "voeu": {
        require_once './controllers/voeu.controller.php';
    } break;
    case "formulaire": {
        require_once './controllers/formulaire.controller.php';
    } break;
    default: break;
}