<?php

/**
 * @Project: FEG Project
 * @File: /controllers/choix.controller.php
 * @Purpose: Ce contrôleur gère l'entité choix
 * @Author: Lionel Guissani
 */
if (!isset($_GET['action'])) {
	$action = "ajout";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action ajoute des choix en base données
	case "ajout": {
			foreach ($_POST['tb'] as $tb) {
				$choixManager->insert(new Choix(0, $_POST['information'], $tb));
			}
			header('location:index.php?uc=information&action=grille&code=' . $_POST['code']);
		} break;
	default: break;
}