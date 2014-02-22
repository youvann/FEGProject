<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/main.controller.php
 * @Purpose:
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
