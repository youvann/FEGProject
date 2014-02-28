<?php

class DocumentGeneral {
	private $id;
	private $nom;
	private $visible;
	
	function __construct($id, $nom, $visible) {
		$this->id = $id;
		$this->nom = $nom;
		$this->visible = $visible;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	/**
	 * @return mixed
	 */
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * @param mixed $visible
	 */
	public function setVisible($visible)
	{
		$this->visible = $visible;
	}

	/**
	 * @return mixed
	 */
	public function getVisible()
	{
		return $this->visible;
	}
}
