<?php

/**
 * @Project: FEG Project
 * @File: /Entities/Ville.php
 * @Purpose: Entité Ville
 * @Author: Lionel Guissani
 */
class Ville
{
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Nom
	 */
	private $nom;

	/**
	 * Constructeur
	 * @param $id string Identfiant
	 * @param $nom string Nom
	 */
	function __construct($id, $nom)
	{
		$this->id = $id;
		$this->nom = $nom;
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
	 * @param string $nom
	 */
	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	/**
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}

}
