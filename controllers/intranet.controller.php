<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose: Ce contrôleur gère les différentes fonctionnalités de l'intranet
 * @Author: Lionel Guissani
 */
if (!isset($_GET['action'])) {
    $action = "accueil";
} else {
    $action = $_GET['action'];
}

switch ($action) {
	// Cette action redirige vers l'accueil de l'intranet
    case "accueil" :
    {
        echo $twig->render ('intranet/accueil.html.twig');
    }
        break;
	// Cette action redirige vers la carte de l'intranet
    case "carte" :
    {
        echo $twig->render ('intranet/carte.html.twig');
    }
        break;
	// Cette action redirige vers l'explorateur de fichiers
    case "explorateur" :
    {
        echo $twig->render ('intranet/explorateur.html.twig', array ('directory' => str_replace (DIRECTORY_SEPARATOR, '/', realpath (dirname (__FILE__))) . '/../dossiers/'));
    }
        break;
    case "telechargerDossier" :
    {
        // Récupère le chemin complet du répertoire à télécharger
        $pathFolder = $_GET['folder'];
        $dirName    = explode ("/", $pathFolder);

        // Récupère le nom du répertoire à télécharger
        $dirName   = $dirName[sizeof ($dirName) - 2];

        // Le chemin mène-t'il vers un fichier ?
        $isFile   = is_file ($pathFolder);
        $fileName = explode ("/", $pathFolder);
        $fileName = $fileName[sizeof ($fileName) - 1];
        $zip      = false;

        if ($dirName !== 'ZIP') {
            // Vérifie si le répertoire et les sous répertoires sont vides
            $empty = IsEmptySubFolders ($pathFolder);
            // Chemin où se trouve le zip à télécharger
            if ($isFile) {
                // Faire correspondre URL au serveur ICI
                $path = $pathFolder;
            } else {
                $path = Zip ($pathFolder, 'dossiers/ZIP/' . $dirName . "-" . time () . '.zip');
            }
        } else {
            $path  = '#';
            $empty = IsEmptySubFolders ($pathFolder);
            $zip   = true;
        }

        echo $twig->render ('intranet/telechargerDossier.html.twig', array ('path' => $path, 'dirName' => $dirName, 'pathFolder' => $pathFolder, 'empty' => $empty, 'zip' => $zip, 'isFile' => $isFile, 'fileName' => $fileName));
    }
        break;
    case "supprimerRepertoire" :
    {
        $isFile = $_GET["isFile"];
        $zip = $_GET["zip"];
        $pathFolder = $_GET["pathFolder"];
        if($isFile){ // fichier
            if(file_exists($pathFolder)){
                unlink($pathFolder);
            }
        }
        else{ // répertoire
            if($zip){
                removeDirContent($pathFolder);
            }else{
                // Suppression du contenu du répertoire concerné
                // Supprime le contenu des répertoires
                listAndRemoveDir ($pathFolder);
            }
        }
        header ('location:index.php?uc=intranet&action=explorateur');
    }
        break;
	// Cette action permet de générer les liens qui donnent un accès paramétré à un dossier PDF
    case "liensFormation":
    {
        $liens = $dossierPdfManager->getLinks ();
        echo $twig->render ('intranet/liensFormation.html.twig', array ('liens' => $liens));
    }
        break;
    default:
        break;
}
