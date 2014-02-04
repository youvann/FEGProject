<?php

/**
 * @Project: FEG Project
 * @File : /controllers/formation.controller.php
 * @Purpose:
 * @Author :
 */
if (!isset($_GET['action'])){
	$action = "grille";
} else{
	$action = $_GET['action'];
}

switch ($action){
	case "consulter":
	{
		$formation = $formationManager->find($_GET['code']);
		echo $twig->render('formation/consulterFormation.html.twig', array('formation' => $formation));
	}
		break;
	case "grille":
	{
		$formations = $formationManager->findAll();
		echo $twig->render('formation/grilleFormation.html.twig', array('formations' => $formations));
	}
		break;
	case "ajouter":
	{
		$facultes = $faculteManager->findAll();
		echo $twig->render('formation/ajouterFormation.html.twig', array('facultes' => $facultes));
	} break;
	case "ajout": {
        // Création du répertoire "code_formation"
        myMkdir($_POST['code_formation']);
		$formationManager->insert(new Formation($_POST['code_formation'], $_POST['mention'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']));
		header('location:index.php?uc=formation&action=grille');
	} break;
	case "modifier": {
		$facultes = $faculteManager->findAll();
		$formation = $formationManager->find($_GET['code']);
		echo $twig->render('formation/modifierFormation.html.twig', array('facultes' => $facultes, 'formation' => $formation));
	} break;
	case "modification": {
		$formation = new Formation($_POST['code_formation'], $_POST['mention'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']);
		$formationManager->update($formation);
		header('location:index.php?uc=formation&action=grille');
	}
		break;
	case "suppression":
	{
		$formation = $formationManager->find($_GET['code']);
		$formationManager->delete($formation);
		header('location:index.php?uc=formation&action=grille');
	}
		break;
	case "codeFormationPossible": {
		$q = $conn->prepare("SELECT IF(count(*) = 1, FALSE, TRUE) as ok FROM `formation` WHERE `code_formation` = ?;");
		$q->execute(array($_POST['code']));
		$rs = $q->fetch();
		$response['response'] = $rs['ok'];
		echo json_encode($response);
	} break;
	case "previsualiserPdf":
	{
		$codeFormation = $_GET['code'];
		echo $twig->render('formation/previsualiserPdfFormation.html.twig', array('codeFormation' => $codeFormation));

	}
		break;
	case "previsualisationPdf":
	{
		$codeFormation = $_GET['code'];
		$formation = $formationManager->find($codeFormation);
		$titulaire = $titulaireManager->findAll();

		$qInfoSupp = $conn->prepare("SELECT * FROM `INFORMATION` WHERE `CODE_FORMATION` = ? ORDER BY `ORDRE`;");
		$qInfoSupp->execute(array($codeFormation));
		$rsInfoSupp = $qInfoSupp->fetchAll();

		// Récupère les informations spécifiques
		$informationsSpecifiques = '';
		foreach($rsInfoSupp as $infoSupp){
			$informationsSpecifiques .= '<div class="bold">'.$infoSupp['LIBELLE'] . ' ' . $infoSupp['EXPLICATIONS'] . ' : </div><br/>';
		}

		// Récupère les voeux possibles
		$qVoeux = $conn->prepare("SELECT * FROM `VOEU` WHERE `CODE_FORMATION` = ?;");
		$qVoeux->execute(array($codeFormation));
		$rsVoeux = $qVoeux->fetchAll();

		// Insère les voeux possibles dans le tableau étapes
		$etapes = array();
		foreach($rsVoeux as $voeu){
			$etapes[] = $voeu['ETAPE'];
		}

		/*$qVille = $conn->prepare("SELECT `VILLE`.`NOM` as `VILLE`
FROM `VOEU` LEFT JOIN `SE_DEROULER` ON (`VOEU`.`CODE_ETAPE` = `SE_DEROULER`.`CODE_ETAPE`)
LEFT JOIN `VILLE` ON (`SE_DEROULER`.`CODE_VET` = `VILLE`.`CODE_VET`)
WHERE `VOEU`.`CODE_FORMATION` = ?;");
$qVille->execute(array($codeFormation));
$rsVille = $qVille->fetchAll();
var_dump($qVille);*/
		/*
$faires = $faireManager->findAllByDossier($dossier);
$etapes = array();
$villesPossibles = array();

// Récupère l'ordre des voeux et les villes où la formation a lieu
foreach ($faires as $faire){
$voeu = $voeuManager->find($faire->getCodeEtape());
$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
$etapes[$faire->getOrdre()] = $voeu->getEtape();

//echo $voeu->getEtape() . ' ' . $faire->getOrdre();
foreach ($lesSeDerouler as $unSeDerouler){
$ville = $villeManager->find($unSeDerouler->getCodeVet());
// echo ' - ' . $ville->getNom();
}
// echo '<br>';
$villesPossibles[] = $ville->getNom();
}
// Supprime les doublons des villes
$villesPossibles = array_unique($villesPossibles);
*/

		require_once './classes/Pdf/PagePdf.class.php';
		$pagePdf = new PagePdf("./classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

		// En-tête du pdf
		$pagePdf->setPagePdfHeaderImgPath("./classes/Pdf/img/feg.png");
		$pagePdf->setPagePdfHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

		// Pied du pdf
		$pagePdf->setPagePdfFooterText("Page [[page_cu]]/[[page_nb]]");

		// Corps du pdf
		$pagePdf->setTitle("Institut supérieur en sciences de Gestion", $formation->getMention());
		$pagePdf->setHolder(' ' . $titulaire[0]->getLibelle(), ' ' . $titulaire[1]->getLibelle(), ' ' . $titulaire[2]->getLibelle(), "titulaire");
		$pagePdf->setPhotoPath('./classes/Pdf/img/photo/github.png');
		$pagePdf->setPlanFormation($etapes, array());
		$pagePdf->setProExperience(array());
		$pagePdf->setInformationsSpecifiques($informationsSpecifiques);

		$pagePdf->setCadreAdministrationVoeux(array("voeux1", "voeux2"));
		$pagePdf->setVoeuxMultiple(true);
		$pagePdf->setRowAdmin(true);

		ob_start();
		echo $pagePdf;
		$content = ob_get_clean();

		// convert in PDF
		require_once './classes/Pdf/html2pdf/html2pdf.class.php';
		try{
			$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(12, 10, 10, 10));
			//$html2pdf->setModeDebug();
			$html2pdf->pdf->addFont('verdana', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdana.php');
			$html2pdf->pdf->addFont('verdanab', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdanab.php');
			$html2pdf->setDefaultFont('verdana');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			//$html2pdf->Output('html2pdf.pdf');
			$html2pdf->Output('dossiers/' . $codeFormation . '/Dossier_Type/Candidature_Type.pdf', 'F');
			//echo "PDF BIEN GENERE";
		} catch (HTML2PDF_exception $e){
			echo $e;
			exit;
		}
		header('location:index.php?uc=formation&action=previsualiserPdf&code=' . $codeFormation);
	}
		break;
	default:
		break;
}
