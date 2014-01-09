<?php

class CheckBoxGroup extends FormElement {

	private $checkBoxes;

	public function __toString() {
		$return = $this->label . "<div>";
		foreach ($this->checkBoxes as $chechBox) {
			$return .= $chechBox;
		}
		return $return . '</div>';
	}

	public function addCheckBox(CheckBox $checkBox) {
		$this->checkBoxes[] = $checkBox;
	}

}
