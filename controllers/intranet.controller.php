<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author :
 */
if (!isset($_GET['action'])) {
    $action = "accueil";
} else {
    $action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
    case "accueil" :
    {
        echo $twig->render('intranet/accueil.html.twig');
    }
        break;
    case "carte" :
    {
        echo $twig->render('intranet/carte.html.twig');
    }
        break;
    case "explorateur" :
    {
        echo $twig->render('intranet/explorateur.html.twig',
            array('directory' => str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__))) . '/../dossiers/')
        );
    }
        break;
    case "telechargerDossier" :
    {
        // Récupère le chemin complet du répertoire à télécharger
        $pathFolder = $_GET['folder'];
        $dirName    = explode("/", $pathFolder);
        // Récupère le nom du répertoire à télécharger
        $dirName    = $dirName[sizeof($dirName) - 2];

        $zip = false;
        if ($dirName !== 'ZIP') {
            // Vérifie si le répertoire et les sous répertoires sont vides
            $empty = IsEmptySubFolders($pathFolder);
            // Chemin où se trouve le zip à télécharger
            $path = Zip($pathFolder, 'dossiers/ZIP/' . $dirName . "-" . time() . '.zip');
        } else {
            $path  = '#';
            $empty = IsEmptySubFolders($pathFolder);
            $zip   = true;
        }

        echo $twig->render('intranet/telechargerDossier.html.twig', array(
            'path'       => $path,
            'dirName'    => $dirName,
            'pathFolder' => $pathFolder,
            'empty'      => $empty,
            'zip'        => $zip
        ));
    }
        break;
    case "supprimerRepertoire" :
    {
        // Suppression du contenu du répertoire concerné
        $pathFolder = $_GET["pathFolder"];
        // Supprime le contenu des répertoires
        listAndRemoveDir($pathFolder);
        header('location:index.php?uc=intranet&action=explorateur');

    }
        break;
    case "liensFormation":
    {
        $liens = $dossierPdfManager->getLinks();
        echo $twig->render('intranet/liensFormation.html.twig', array('liens' => $liens));
    }
        break;
    default:
        break;
}
