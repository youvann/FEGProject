<?php

class DocumentGeneral {
	private $id;
	private $nom;
    private $multiple;
	
	function __construct($id, $nom, $multiple) {
		$this->id = $id;
		$this->nom = $nom;
        $this->multiple = $multiple;
	}

	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

    public function getMultiple(){
        return $this->multiple;
    }

	public function setId($id) {
		$this->id = $id;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

    public function setMultiple ($multiple){
        $this->multiple = $multiple;
    }

}
