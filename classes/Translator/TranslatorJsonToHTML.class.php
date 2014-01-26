<?php

/**
 * @Project: FEG Project
 * @File: /classes/Translator/TranslatorJsonToHTML.class.php
 * @Purpose: Cette classe a pour rôle de traduire les informations
 * supplémentaires stockées au format JSON en base de donnée au format HTML
 * @Author: Lionel Guissani
 */
class TranslatorJsonToHTML extends Translator {
	
	/**
	 * Traduit les informations supplémentaires stockées au 
	 * format JSON en base de donnée au format HTML
	 * @param string $json informations supplémentaires au format Json
	 * @param array $structure Le tableau php contenant les
	 * informations supplémentaires demandées par une formation.
	 * @return string Le résultat HTML des réponses aux 
	 * informations supplémentaires
	 */
	public function translate($json, $structure) {
		// Transformation du Json en tableau PHP associatif
		$json = (array) json_decode($json, true);
		// Création de la chaîne de retour
		$html = '';
		for ($i = 0; $i < count($structure); ++$i) {
			// On définit l'action à faire en fonction du type de l'information
			// courante.
			switch ($structure[$i][2]) {
				// Récupération de la donnée formatée dans le cas d'une zone de texte.
				case "TextBox": $html .= $this->textBoxJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				// Récupération de la donnée formatée dans le cas d'une zone de texte multiligne.
				case "TextArea": $html .= $this->textAreaJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				// Récupération de la donnée formatée dans le cas d'une case à cocher.
				case "CheckBox": $html .= $this->checkBoxJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				// Récupération des données formatées dans le cas d'un groupe de cases à cocher.
				case "CheckBoxGroup": $html .= $this->checkBoxGroupJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1], $structure[$i][3]); break;
				// Récupération des données formatées dans le cas d'un groupe de boutons radio.
				case "RadioButtonGroup": $html .= $this->radioButtonGroupJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
			default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">'.$structure[$i][2].'</span></div>'; break;
			}
		}
		return $html;
	}

	/**
	 * Récupère la donnée à afficher et la traite pour la rendre
	 * au format HTML ajusté pour une zone de texte.
	 * @param array $data Tableau contenant la donnée à afficher
	 * @param string $idInfo Clé du tableau contenant la donnée à afficher
	 * @param string $label Libellé de la donnée à afficher
	 * @return string Donnée avec son libellé au format HTML
	 */
	private function textBoxJsonToHTML($data, $idInfo, $label) {
		return "<span class='bold'>" . $label . " : </span>" . $data[$idInfo] . "<br /><br />";
	}

	/**
	 * Récupère la donnée à afficher et la traite pour la rendre
	 * au format HTML ajusté pour une zone de texte multiligne.
	 * @param array $data Tableau contenant la donnée à afficher
	 * @param string $idInfo Clé du tableau contenant la donnée à afficher
	 * @param string $label Libellé de la donnée à afficher
	 * @return string Donnée avec son libellé au format HTML
	 */
	private function textAreaJsonToHTML($data, $idInfo, $label) {
		return "<span class='bold'>" . $label . " : </span>" . $data[$idInfo] . "<br /><br />";
	}
	
	/**
	 * Récupère la donnée à afficher et la traite pour la rendre
	 * au format HTML ajusté pour une case à cocher.
	 * @param array $data Tableau contenant la donnée à afficher
	 * @param string $idInfo Clé du tableau contenant la donnée à afficher
	 * @param string $label Libellé de la donnée à afficher
	 * @return string Donnée avec son libellé au format HTML
	 */
	private function checkBoxJsonToHTML($data, $idInfo, $label) {
		return "<span class='bold'>" . $label . " : </span>" . $data[$idInfo] . '<br /><br />';
	}
	
	/**
	 * Récupère les données à afficher et la traite pour la rendre
	 * au format HTML ajusté pour un un groupe de cases à cocher.
	 * @param array $data Tableau contenant la donnée à afficher
	 * @param string $idInfo Clé du tableau contenant la donnée à afficher
	 * @param string $label Libellé du groupe de données à afficher
	 * @param string $labels Libellés des données à afficher
	 * @return string Données avec leurs libellés au format HTML
	 */
	private function checkBoxGroupJsonToHTML($datas, $idInfo, $label, $labels) {
		$return = $label . " : ";
		// Pour chaque réponse possible, on met Oui ou Non
		for ($i = 0; $i < count($datas[$idInfo]); ++$i) {
			$return .= "<span class='bold'>" . $labels[$i] . ' : </span>' . $datas[$idInfo][$i] . ($i === count($datas[$idInfo]) - 1 ? '.<br /><br />' : ', ');
		}
		return $return;
	}
	
	/**
	 * Récupère la donnée à afficher et la traite pour la rendre
	 * au format HTML ajusté pour un groupe de boutons radio.
	 * @param array $data Tableau contenant la donnée à afficher
	 * @param string $idInfo Clé du tableau contenant la donnée à afficher
	 * @param string $label Libellé de la donnée à afficher
	 * @return string Donnée avec son libellé au format HTML
	 */
	private function radioButtonGroupJsonToHTML($data, $idInfo, $label) {
		return "<span class='bold'>" . $label . " : </span>" . $data[$idInfo] . '<br /><br />';
	}
}
