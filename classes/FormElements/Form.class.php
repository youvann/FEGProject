<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Form.class.php
 * @Purpose: Cette classe représente un formulaire HTML.
 * @Author: Lionel Guissani
 */
class Form {
	/**
	 * @var string Méthode de requête du formulaire
	 */
	private $method;
	/**
	 * @var string Page cible du formulaire
	 */
	private $action;
	/**
	 * @var bool Booléan pour savoir si le formulaire
	 * permet ou non l'upload de fichiers
	 */
	private $uploadForm;
	/**
	 * @var array Eléments du formulaire
	 */
	private $formElements;

	/**
	 * Constructeur du formulaire
	 * @param $method string Méthode de requête
	 * @param $action string
	 * @param bool $uploadForm
	 */
	public function __construct($method, $action, $uploadForm = false) {
		$this->method = $method;
		$this->action = $action;
		$this->uploadForm = $uploadForm;
	}

	/**
	 * Ajoute un objet FormElement à la propriété $formElements.
	 * @param type $formElement Instance d'un objet FormElement
	 */
	public function addFormElement($formElement) {
		$this->formElements[] = $formElement;
	}

	/**
	 * @return string Code html du formulaire
	 */
	public function __toString() {
		$return = '<form role="form" method="' . $this->method . '" action="' . $this->action . '"' . ($this->uploadForm === true ? ' enctype="multipart/form-data"' : '') . '>';
		foreach ($this->formElements as $formElement) {
			$return .= '<div class="form-group">' . $formElement . '</div>';
		}
		return $return . '<input class="btn btn-primary" type="submit" /></form>';
	}

	/**
	 * Cette méthode retourne le code html du formulaire
	 * sans les balises <form> de manière à être inclu
	 * dans un autre formulaire HTML.
	 * @return string Code html du formulaire sans les balises <form>
	 */
	public function getHTML() {
		$return = '';
		if (is_null($this->formElements)) {
			return null;
		}
		foreach ($this->formElements as $formElement) {
			$return .= '<div class="form-group">' . $formElement . '</div>';
		}
		return $return;
	}
}