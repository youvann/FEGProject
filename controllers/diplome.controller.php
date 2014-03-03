<?php

/**
 * @Project: FEG Project
 * @File: /controllers/pieceAJoindre.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "ajout": {
		$diplomeManager->insert(new Diplome(0, $_POST['nom'], $_POST['dossier_pdf']));
		header('location:index.php?uc=dependre&action=grille&dossierPdf='.$_POST['dossier_pdf']);
    } break;
    case "suppression": {
        $diplome = $diplomeManager->find($_GET['idDiplome']);
		$diplomeManager->delete($diplome);
        header('location:index.php?uc=dependre&action=grille&dossierPdf='.$diplome->getDossierPdf());
    } break;
    default: break;
}
