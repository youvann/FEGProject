<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/RadioButtonGroup.class.php
 * @Purpose: Cette classe représente un groupe de boutons radio HTML.
 * @Author: Lionel Guissani
 */
class RadioButtonGroup extends FormElement {
	/**
	 * @var Boutons radio
	 */
	private $radioButtons;

	/**
	 * @return string Code HTML du groupe de boutons radio
	 */
	public function __toString() {
		// Le groupe de boutons radio est composé de son
		// label et d'une DIV qui contient les boutons radio
		$return = $this->label . "<div>";
		$i = 0;
		// On parcours la liste des boutons radio
		// pour récupérer leur code HTML
		foreach ($this->radioButtons as $radioButton) {
			// On coche par défaut le 1er bouton radio
			if ($i === 0) {
				$radioButton->setChecked(true);
			}
			$return .= $radioButton;
			++$i;
		}
		return $return . '</div>';
	}

	/**
	 * Ajoute un objet RadioButton à la propriété $radioButtons.
	 * @param RadioButton $radioButton Instance de la classe radioButton.
	 */
	public function addRadioButton(RadioButton $radioButton) {
		$this->radioButtons[] = $radioButton;
	}

}