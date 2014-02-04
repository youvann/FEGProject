<?php

$droits = array(
	array(// Anonymous
		array("formulaire", "candidaturePossible"),
		array("formulaire", "choixFormation"),
		array("formulaire", "traiterChoixFormation"),
		array("formulaire", "displayDocuments"),
		array("formulaire", "main"),
		array("formulaire", "traiterMainFormulaire"),
        array("formulaire", "recapitulatif"),
		array("utilisateur", "connecter"),
		array("utilisateur", "connexion"),
		array("intranet", "generationPdfCandidature"),
	),array(// Secretaire
		array("documentGeneral", "grille"),
		array("documentSpecifique", "grille"),
		array("formation", "consulter"),
		array("formation", "grille"),
		array("formation", "previsualiserPdf"),
		array("formation", "previsualisationPdf"),
		array("information", "grille"),
		array("information", "consulter"),
		array("intranet", "supprimerRepertoire"),
		array("intranet", "accueil"),
		array("intranet", "carte"),
		array("intranet", "explorateur"),
		array("intranet", "telechargerDossier"),
		array("intranet", "liensFormation"),
		array("utilisateur", "deconnexion"),
		array("voeu", "consulter"),
		array("voeu", "grille")
	),array(// Responsable
		array("choix", "ajouter"),
		array("choix", "ajout"),
		array("documentSpecifique", "ajouter"),
		array("documentSpecifique", "ajout"),
		array("documentSpecifique", "modifier"),
		array("documentSpecifique", "modification"),
		array("documentSpecifique", "suppression"),
		array("formation", "ajouter"),
		array("formation", "ajout"),
		array("formation", "modifier"),
		array("formation", "modification"),
		array("formation", "codeFormationPossible"),
		array("information", "ajouter"),
		array("information", "ajout"),
		array("information", "suppression"),
		array("information", "ordonnancement"),
		array("voeu", "ajouter"),
		array("voeu", "ajout"),
		array("voeu", "modifier"),
		array("voeu", "modification"),
		array("voeu", "suppression"),
		array("voeu", "codeEtapePossible")
	),array(// Administrateur
		array("formation", "suppression"),
		array("documentGeneral", "ajouter"),
		array("documentGeneral", "ajout"),
		array("documentGeneral", "modifier"),
		array("documentGeneral", "modification"),
		array("documentGeneral", "suppression"),
	)
);
