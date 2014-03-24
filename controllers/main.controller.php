<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/main.controller.php
 * @Purpose: Ce super contrôleur charge le bon contrôleur en fonction de la variable $uc
 * @Author :
 */
if (!isset($_GET['uc'])){
    $uc = "formulaire";
} else{
    $uc = $_GET['uc'];
}

switch ($uc){
    case "formation":
    {
        require_once 'controllers/formation.controller.php';
    }
        break;
	case "dateLimite":
	{
		require_once 'controllers/dateLimite.controller.php';
	}
		break;
	case "dependre":
	{
		require_once 'controllers/dependre.controller.php';
	}
		break;
	case "diplome":
	{
		require_once 'controllers/diplome.controller.php';
	}
		break;
    case "documentGeneral":
    {
        require_once 'controllers/documentGeneral.controller.php';
    }
        break;
    case "documentSpecifique":
    {
        require_once 'controllers/documentSpecifique.controller.php';
    }
        break;
    case "information":
    {
        require_once 'controllers/information.controller.php';
    }
        break;
    case "voeu":
    {
        require_once 'controllers/voeu.controller.php';
    }
        break;
    case "intranet":
    {
        require_once 'controllers/intranet.controller.php';
    }
        break;
    case "formulaire":
    {
        require_once 'controllers/formulaire.controller.php';
    }
		break;
	case "dossierPdf":
	{
		require_once 'controllers/dossierPdf.controller.php';
	}
        break;
    case "utilisateur":
    {
        require_once 'controllers/utilisateur.controller.php';
    }
        break;
    default:
        break;
}
