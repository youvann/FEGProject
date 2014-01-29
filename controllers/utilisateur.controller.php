<?php

/**
 * @Project: FEG Project
 * @File: /controllers/utilisateur.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "connecter";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	case "connecter": {
			echo $twig->render('utilisateur/formConnecter.html.twig');
		} break;
	case "connexion": {
			$q = $conn->prepare('select count(*) from `utilisateur` where `utilisateur`.`LOGIN` = ? and `utilisateur`.`PASSWORD` = md5(?);');
			$q->execute(array($_POST['login'], $_POST['password']));
			$rs = $q->fetch();
			if ($rs[0] === '1') {
				$_SESSION['name'] = 'Administrateur';
				$_SESSION['grade'] = 4;
				$_SESSION['rights'] = $droits[$_SESSION['grade'] - 1];
				header('location:index.php?uc=intranet&action=accueil');
			} else {
				header('location:index.php');
			}
		} break;
	case "deconnexion": {
			session_destroy();
			$_SESSION['name'] = 'Anonymous';
			$_SESSION['rights'] = $anonymous;
			header('location:index.php');
		} break;
	default: break;
}