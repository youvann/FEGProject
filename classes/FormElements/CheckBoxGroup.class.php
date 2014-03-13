<?php


/**
 * @Project: FEG Project
 * @File: /classes/FormElement/CheckBoxGroup.class.php
 * @Purpose: Cette classe représente un
 * groupe de cases à cocher liste déroulante HTML.
 * @Author: Lionel Guissani
 */
class CheckBoxGroup extends FormElement {
	/**
	 * @var array Cases à cocher
	 */
	private $checkBoxes;

	/**
	 * @return string Code HTML du groupe de cases à cocher
	 */
	public function __toString() {
		$return = $this->label . "<div>";
		foreach ($this->checkBoxes as $chechBox) {
			$return .= $chechBox;
		}
		return $return . '</div>';
	}

	/**
	 * Ajoute un objet RadioButton à la propriété $checkboxes..
	 * @param CheckBox $checkBox Instance de la classe CheckBox.
	 */
	public function addCheckBox(CheckBox $checkBox) {
		$this->checkBoxes[] = $checkBox;
	}

}
