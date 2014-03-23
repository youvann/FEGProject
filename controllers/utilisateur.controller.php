<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/utilisateur.controller.php
 * @Purpose: Contrôleur de la fonctionnalité comptes utilisateurs
 * @Author : Lionel Guissani
 */
if (!isset($_GET['action'])){
    $action = "connecter";
} else{
    $action = $_GET['action'];
}

switch ($action){
	// Cette action mène au formulaire de connexion
    case "connecter":
    {
        echo $twig->render('utilisateur/formConnecter.html.twig');
    }
        break;
	// Cette action connecte au système l'utilisateur
    case "connexion":
    {
		// On prépare la requête qui permet de savoir si l'utilisateur existe
        $q = $conn->prepare('select count(*), `LOGIN`, `PASSWORD`, `DROITS` from `utilisateur` where `utilisateur`.`LOGIN` = ? and `utilisateur`.`PASSWORD` = md5(?);');
        // On execute la requête
		$q->execute(array ($_POST['login'], $_POST['password']));
		// On récupère le résultat
        $rs = $q->fetch();
		// Si l'utilisateur existe, on le connecte au système
        if ($rs[0] === '1'){
            $_SESSION['name'] = $rs['LOGIN'];
            $_SESSION['grade'] = $rs['DROITS'];
            $lesDroits = array ();
			// On, attribue les droits à l'utilisateur en fonction de son grade
            for ($i = 0; $i <= $_SESSION['grade']; ++$i) {
                $lesDroits = array_merge($lesDroits, $droits[$i]);
            }
            $_SESSION['rights'] = $lesDroits;
			// On redirige l'utulisateur vers la page d'accueil de l'intranet
            header('location:index.php?uc=intranet&action=accueil');
        } else{
			// Si l'utilisateur n'existe pas, on le redirige vers la page d'accueil
            header('location:index.php');
        }
    }
        break;
	// Cette action déconnecte l'utilisateur du système
    case "deconnexion":
    {
		// On détruit la session
        session_destroy();
		// On vide la variable superglobale de session
		$_SESSION = array();
		// On se redirige vers la page d'accueil
        header('location:index.php');
    }
        break;
    default:
        break;
}
