<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Choix.php
 * @Purpose: Entité Choix
 * @Author: Lionel Guissani
 */
class Choix {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Indentifiant de
	 * l'nformation à laquelle il appartient
	 */
	private $information;
	/**
	 * @var string Texte
	 */
	private $texte;

	/**
	 * Contructeur
	 * @param $id string Identifiant
	 * @param $information string Indentifiant de
	 * l'nformation à laquelle il appartient
	 * @param $texte string Texte
	 */
	function __construct($id, $information, $texte) {
		$this->id = $id;
		$this->information = $information;
		$this->texte = $texte;
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
	 * @param string $information
	 */
	public function setInformation($information)
	{
		$this->information = $information;
	}

	/**
	 * @return string
	 */
	public function getInformation()
	{
		return $this->information;
	}

	/**
	 * @param string $texte
	 */
	public function setTexte($texte)
	{
		$this->texte = $texte;
	}

	/**
	 * @return string
	 */
	public function getTexte()
	{
		return $this->texte;
	}
}
