<?php

class TranslatorStructureToForm extends Translator {

	/**
	 * Passe les informations requises du format de tableau
	 * au format formulaire HTML
	 * @param array $structure
	 */
	public function translate($structure) {
		$form = new Form("POST", "testTranslatorStructureToForm.php");

		for ($i = 0; $i < count($structure); ++$i) {
			switch ($structure[$i][2]) {
				case "TextBox": $form->addFormElement($this->textBoxToForm($i, $structure[$i][1]));
					break;
				case "TextArea": $form->addFormElement($this->textAreaToForm($i, $structure[$i][1]));
					break;
				case "CheckBox": $form->addFormElement($this->checkBoxToForm($i, $structure[$i][1]));
					break;
				case "CheckBoxGroup": $form->addFormElement($this->checkBoxGroupToForm($i, $structure[$i][1], $structure[$i][3]));
					break;
				case "RadioButtonGroup": $form->addFormElement($this->radioButtonGroupToForm($i, $structure[$i][1], $structure[$i][3]));;
					break;
				default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">' . $structure[$i][2] . '</span></div>';
					break;
			}
		}
		echo $form;
	}

	private function textBoxToForm($i, $label) {
		$textBox = new TextBox("elem-" . $i, "elem-" . $i, "");
		$textBox->setLabel(new Label("elem-" . $i, $label));
		return $textBox;
	}

	private function textAreaToForm($i, $label) {
		$textArea = new TextArea("elem-" . $i, "elem-" . $i, "");
		$textArea->setLabel(new Label("elem-" . $i, $label));
		return $textArea;
	}

	private function checkBoxGroupToForm($i, $label, $labels) {
		$checkBoxGroup = new CheckBoxGroup();
		$checkBoxGroup->setLabel(new Label("", $label));

		for ($j = 0; $j < count($labels); ++$j) {
			//$checkBox = new CheckBox("elem-".$i."-".$j, "elem-".$i."-".$j."[]", "elem-".$i."-".$j);
			$checkBox = new CheckBox("elem-".$i."-".$j, "elem-".$i."-".$j."[]", $labels[$j]); // Remplacente
			$checkBox->setLabel(new Label("elem-".$i."-".$j, $labels[$j]));
			$checkBoxGroup->addCheckBox($checkBox);
		}
		return $checkBoxGroup;
	}

	private function checkBoxToForm($i, $label) {
		$checkBox = new CheckBox("elem-" . $i, "elem-" . $i, "elem-" . $i);
		$checkBox->setLabel(new Label("elem-" . $i, $label));
		return $checkBox;
	}

	private function radioButtonGroupToForm($i, $label, $labels) {
		$radioButtonGroup = new RadioButtonGroup();
		$radioButtonGroup->setLabel(new Label("", $label));

		for ($j = 0; $j < count($labels); ++$j) {
			$radioButton = new RadioButton("elem-".$i."-".$j, "elem-".$i, $labels[$j]);
			$radioButton->setLabel(new Label("elem-".$i, $labels[$j]));
			$radioButtonGroup->addRadioButton($radioButton);
		}
		return $radioButtonGroup;
	}

}
