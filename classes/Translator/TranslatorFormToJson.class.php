<?php

/**
 * @Project: FEG Project
 * @File: /classes/Translator/TranslatorFormToJson.class.php
 * @Purpose: Cette classe a pour rôle de traduire les informations
 * supplémentaires reçues du formulaire au format JSON.
 * @Author: Lionel Guissani
 */
class TranslatorFormToJson extends Translator
{

	/**
	 * Traduit les informations supplémentaires
	 * reçues du formulaire au format JSON
	 * @param type $structure Le tableau php contenant les
	 * informations supplémentaires demandées par une formation.
	 * @param type $post La variable superglobale $_POST
	 * @return string JSONcontenant les
	 * informations supplémentaires.
	 */
	public function translate($structure, $post)
	{
		$keys = array_keys($post);
		$json = array();
		$j = 0;
		for ($i = 0; $i < count($structure); ++$i) {
			switch ($structure[$i][2]) {
				// Récupération de la donnée dans le cas d'une zone de texte.
			case "TextBox":
				$json[] = $this->textBoxPostToJson($structure[$i][0], $post[$keys[$j]]);
				break;
				// Récupération de la donnée dans le cas d'une zone de texte multiligne.
			case "TextArea":
				$json[] = $this->textAreaPostToJson($structure[$i][0], $post[$keys[$j]]);
				break;
				// Récupération de la donnée dans le cas d'une case à cocher.
			case "CheckBox":
			{
				if (array_key_exists("elem-" . $i, $post)) {
					$json[] = $this->checkBoxPostToJson($structure[$i][0]);
				} else {
					$json[] = $this->checkBoxUncheckedPostToJson($structure[$i][0]);
					--$j;
				}
			}
				break;
				// Récupération de la donnée dans le cas d'un groupe de cases à cocher.
			case "CheckBoxGroup":
			{
				if (array_key_exists("elem-" . $j, $post)) {
					// Si au moins une case est cochée, on récupères les informations
					$json[] = $this->checkBoxGroupPostToJson($structure[$i][0], $post[$keys[$j]], $structure[$i][3]);
				} else {
					// Si aucune case n'est cochée, on récupère les informations mises toutes à "Non"
					$json[] = $this->checkBoxGroupUncheckedPostToJson($structure[$i][0], $structure[$i][3]);
					--$j;
				}
			}
				break;
				// Récupération de la donnée dans le cas d'un groupe de boutons radio
			case "RadioButtonGroup":
				$json[] = $this->radioButtonGroupPostToJson($structure[$i][0], $post[$keys[$j]]);
				break;
			default:
				echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">' . $structure[$i][1] . '</span></div>';
				break;
			}
			++$j;
		}
		return json_encode($json);
	}

	/**
	 * Récupère l'information dans $_POST dans le cas d'une zone de texte.
	 * @param string $idInfo Identifiant de l'information
	 * @param string $post Sous-parie de la variable $_POST
	 * @return array Information récupéré sous forme de tableau
	 */
	public function textBoxPostToJson($idInfo, $post)
	{
		return array($idInfo => $post);
	}

	/**
	 * Récupère l'information dans $_POST dans le cas d'une
	 * zone de texte multilignes.
	 * @param string $idInfo Identifiant de l'information
	 * @param string $post Sous-parie de la variable $_POST
	 * @return array Information récupéré sous forme de tableau
	 */
	public function textAreaPostToJson($idInfo, $post)
	{
		return array($idInfo => $post);
	}

	/**
	 * Met "Oui" pour le libellé de l'information
	 * @param string $idInfo Identifiant de l'information
	 * @param string $post Sous-parie de la variable $_POST
	 * @return array Information récupéré sous forme de tableau
	 */
	public function checkBoxPostToJson($idInfo)
	{
		return array($idInfo => 'Oui');
	}

	/**
	 * Met "Non" pour le libellé de l'information
	 * @param string $idInfo Identifiant de l'information
	 * @return array Information récupéré sous forme de tableau
	 */
	public function checkBoxUncheckedPostToJson($idInfo)
	{
		return array($idInfo => 'Non');
	}

	/**
	 * Récupère l'information dans $_POST dans le cas
	 * d'un groupe de cases à cocher.
	 * @param string $idInfo Identifiant de l'information
	 * @param array $post Sous-parie de la variable $_POST
	 * @param array $labels Description
	 * @return array Information récupéré sous forme de tableau
	 */
	public function checkBoxGroupPostToJson($idInfo, $post, $labels)
	{
		$res = array();
		for ($i = 0; $i < count($labels); ++$i) {
			$res[] = in_array($labels[$i], $post) ? 'Oui' : 'Non';
		}
		return array($idInfo => $res);
	}

	/**
	 * Met "Non" pour chaque libellé de l'information
	 * @param string $idInfo Identifiant de l'information
	 * @param type $labels Libellés des cases à cocher
	 * @return array Information récupéré sous forme de tableau
	 */
	public function checkBoxGroupUncheckedPostToJson($idInfo, $labels)
	{
		$res = array();
		for ($i = 0; $i < count($labels); ++$i) {
			$res[] = 'Non';
		}
		return array($idInfo => $res);
	}

	/**
	 * Récupère l'information dans $_POST dans le cas
	 * d'un groupe de boutons radio.
	 * @param string $idInfo Identifiant de l'information
	 * @param string $post Sous-parie de la variable $_POST
	 * @return array Information récupéré sous forme de tableau
	 */
	public function radioButtonGroupPostToJson($idInfo, $post)
	{
		return array($idInfo => $post);
	}

}
