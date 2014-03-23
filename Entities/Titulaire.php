<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Titulaire.php
 * @Purpose: Entité Titulaire
 * @Author: Lionel Guissani
 */
class Titulaire {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Libellé
	 */
	private $libelle;

	/**
	 * Constructeur
	 * @param $id string Identfiant
	 * @param $libelle string Libellé
	 */
	function __construct($id, $libelle) {
		$this->id = $id;
		$this->libelle = $libelle;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $libelle
	 */
	public function setLibelle($libelle)
	{
		$this->libelle = $libelle;
	}

	/**
	 * @return string
	 */
	public function getLibelle()
	{
		return $this->libelle;
	}

}
