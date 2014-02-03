<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/utilisateur.controller.php
 * @Purpose:
 * @Author :
 */
if (!isset($_GET['action'])){
    $action = "connecter";
} else{
    $action = $_GET['action'];
}

switch ($action){
    case "connecter":
    {
        echo $twig->render('utilisateur/formConnecter.html.twig');
    }
        break;
    case "connexion":
    {
        $q = $conn->prepare('select count(*), `LOGIN`, `PASSWORD`, `DROITS` from `utilisateur` where `utilisateur`.`LOGIN` = ? and `utilisateur`.`PASSWORD` = md5(?);');
        $q->execute(array ($_POST['login'], $_POST['password']));
        $rs = $q->fetch();
        if ($rs[0] === '1'){
            $_SESSION['name'] = $rs['LOGIN'];
            $_SESSION['grade'] = $rs['DROITS'];
            $lesDroits = array ();
            for ($i = 0; $i <= $_SESSION['grade']; ++$i) {
                $lesDroits = array_merge($lesDroits, $droits[$i]);
            }
            $_SESSION['rights'] = $lesDroits;
            header('location:index.php?uc=intranet&action=accueil');
        } else{
            header('location:index.php');
        }
    }
        break;
    case "deconnexion":
    {
        session_destroy();
		$_SESSION = array();
        header('location:index.php');
    }
        break;
    default:
        break;
}
