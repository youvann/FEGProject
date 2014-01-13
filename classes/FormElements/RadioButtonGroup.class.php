<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/RadioButtonGroup.class.php
 * @Purpose: Cette classe représente un groupe de boutons radio HTML.
 * @Author: Lionel Guissani
 */
class RadioButtonGroup extends FormElement {

	private $radioButtons;

	public function __toString() {
		$return = $this->label . "<div>";
		$i = 0;
		foreach ($this->radioButtons as $radioButton) {
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