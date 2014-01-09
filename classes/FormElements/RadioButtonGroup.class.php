<?php

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

	public function addRadioButton(RadioButton $radioButton) {
		$this->radioButtons[] = $radioButton;
	}

}