<?php

class DocumentSpecifique {
	private $id;
	private $code;
	private $nom;
	private $url;
    private $multiple;
	
	function __construct($id, $code, $nom, $url, $multiple) {
		$this->id = $id;
		$this->code = $code;
		$this->nom = $nom;
		$this->url = $url;
        $this->multiple = $multiple;
	}

	public function getId() {
		return $this->id;
	}

	public function getCode() {
		return $this->code;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getUrl() {
		return $this->url;
	}

    public function getMultiple (){
        return $this->multiple;
    }

	public function setId($id) {
		$this->id = $id;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

    public function setMultiple($multiple){
        $this->multiple = $multiple;
    }


}
