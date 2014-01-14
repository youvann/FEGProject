<?php

/**
 * @Project: FEG Project
 * @File: /classes/Translator/TranslatorStructureToForm.class.php
 * @Purpose: Cette classe a pour rôle de traduire 
 * les informations supplémentaires pour une formation en formulaire HTML.
 * @Author: Lionel Guissani
 */
class TranslatorStructureToForm extends Translator {
	/**
	 * Traduit les informations supplémentaires 
	 * pour une formation en formulaire HTML.
	 * @param array $structure Le tableau php contenant les
	 * informations supplémentaires demandées par une formation.
	 * @return \Form Instance de la classe Form contenant les éléments
	 * de formulaires correspondant aux informations supplémentaires 
	 * demandées par la formation.
	 */
	public function translate($structure) {
		// Création du formulaire qui récoltera les informations
		$form = new Form("POST", "testTranslatorFormToJson.php");
		// On explore la structure de l'ensemble des informations
		for ($i = 0; $i < count($structure); ++$i) {
			// On définit l'action à faire en fonction du type de l'information
			// courante.
			switch ($structure[$i][2]) {
				// Ajout dans le formulaire d'une zone de texte.
				case "TextBox": $form->addFormElement($this->textBoxStructureToForm($i, $structure[$i][1]));
					break;
				// Ajout dans le formulaire d'une zone de texte multiligne.
				case "TextArea": $form->addFormElement($this->textAreaStructureToForm($i, $structure[$i][1]));
					break;
				// Ajout dans le formulaire d'une case à cocher.
				case "CheckBox": $form->addFormElement($this->checkBoxStructureToForm($i, $structure[$i][1]));
					break;
				// Ajout dans le formulaire d'un groupe de cases à cocher.
				case "CheckBoxGroup": $form->addFormElement($this->checkBoxGroupStructureToForm($i, $structure[$i][1], $structure[$i][3]));
					break;
				// Ajout dans le formulaire d'un groupe de boutons radio.
				case "RadioButtonGroup": $form->addFormElement($this->radioButtonGroupStructureToForm($i, $structure[$i][1], $structure[$i][3]));
					break;
				// A retirer pour la mise en production
				default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">' . $structure[$i][2] . '</span></div>';
					break;
			}
		}
		return $form;
	}
	
	/**
	 * Gérère un groupe de cases à cocher avec un libellé pour chaque
	 * case et un libellé pour le groupe.
	 * @param int $i Partie numérique de l'identifiant du groupe de cases
	 * à cocher à générer, préfixée par "elem-".
	 * @param string $label Libellé du groupe de cases à cocher.
	 * @param array $labels Libellés pour chaque case à cocher du groupe.
	 * @return \CheckBoxGroup Groupe de cases à cocher généré.
	 */
	private function checkBoxGroupStructureToForm($i, $label, $labels) {
		// Instanciation d'un objet groupe de cases à cocher
		$checkBoxGroup = new CheckBoxGroup();
		// On attache au groupe de cases à cocher son libellé
		$checkBoxGroup->setLabel(new Label("", $label));

		for ($j = 0; $j < count($labels); ++$j) {
			$checkBox = new CheckBox("elem-".$i."-".$j, "elem-".$i."[]", $labels[$j]);
			$checkBox->setLabel(new Label("elem-".$i."-".$j, $labels[$j]));
			$checkBoxGroup->addCheckBox($checkBox);
		}
		return $checkBoxGroup;
	}

	/**
	 * Gérère une case à cocher avec un libellé
	 * @param int $i Partie numérique de l'identifiant de la case à cocher
	 * à générer, préfixée par "elem-".
	 * @param string $label Libellé de la zone de texte multiligne.
	 * @return \CheckBox case à cocher générée.
	 */
	private function checkBoxStructureToForm($i, $label) {
		// Instanciation d'un objet case à cocher
		$checkBox = new CheckBox("elem-" . $i, "elem-" . $i, "elem-" . $i);
		// On attache à la case à cocher son libellé
		$checkBox->setLabel(new Label("elem-" . $i, $label));
		return $checkBox;
	}
	
	/**
	 * Gérère un groupe de boutons radio avec un libellé pour chaque
	 * bouton radio et un libellé pour le groupe.
	 * @param int $i Partie numérique de l'identifiant du groupe de boutons
	 * radio à générer, préfixée par "elem-".
	 * @param string $label Libellé du groupe de boutons radio.
	 * @param array $labels Libellés pour chaque bouton radio du groupe.
	 * @return \RadioButtonGroup Groupe de boutons radio généré.
	 */
	private function radioButtonGroupStructureToForm($i, $label, $labels) {
		// Instanciation d'un objet groupe de boutons radio
		$radioButtonGroup = new RadioButtonGroup();
		// On attache au groupe de boutons radio son libellé
		$radioButtonGroup->setLabel(new Label("", $label));

		for ($j = 0; $j < count($labels); ++$j) {
			$radioButton = new RadioButton("elem-".$i."-".$j, "elem-".$i, $labels[$j]);
			$radioButton->setLabel(new Label("elem-".$i, $labels[$j]));
			$radioButtonGroup->addRadioButton($radioButton);
		}
		return $radioButtonGroup;
	}

	/**
	 * Gérère une zone de texte multiligne avec un libellé
	 * @param int $i Partie numérique de l'identifiant de la zone de texte
	 * multiligne à générer, préfixée par "elem-".
	 * @param string $label Libellé de la zone de texte multiligne.
	 * @return \TextArea Zone de texte multiligne générée.
	 */
	private function textAreaStructureToForm($i, $label) {
		// Instanciation d'un objet zone de texte multiligne
		$textArea = new TextArea("elem-" . $i, "elem-" . $i, "");
		// On attache à la case à cocher son libellé
		$textArea->setLabel(new Label("elem-" . $i, $label));
		return $textArea;
	}
	
	/**
	 * Gérère une zone de texte avec un libellé
	 * @param int $i Partie numérique de l'identifiant de la zone de texte
	 * à générer, préfixée par "elem-".
	 * @param string $label Libellé de la zone de texte.
	 * @return \TextBox Zone de texte générée.
	 */
	private function textBoxStructureToForm($i, $label) {
		// Instanciation d'un objet zone de texte
		$textBox = new TextBox("elem-" . $i, "elem-" . $i, "");
		// On attache à la case à cocher son libellé
		$textBox->setLabel(new Label("elem-" . $i, $label));
		return $textBox;
	}
}
