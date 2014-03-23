<?php
/**
 * @Project: FEG Project
 * @File: /Entities/SeDerouler.php
 * @Purpose: Entité SeDerouler
 * @Author: Lionel Guissani
 */
class SeDerouler {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Code étape
	 */
	private $codeEtape;
	/**
	 * @var string Responsable
	 */
	private $responsable;
	/**
	 * @var string Adresse mail du responsable
	 */
	private $mailResponsable;

	/**
	 * Constructeur
	 * @param $id string Identifiant
	 * @param $codeEtape string Code étape
	 * @param $responsable string Responsable
	 * @param $mailResponsable string Adresse mail du responsable
	 */
	function __construct($id, $codeEtape, $responsable, $mailResponsable) {
		$this->id = $id;
		$this->codeEtape = $codeEtape;
		$this->responsable = $responsable;
		$this->mailResponsable = $mailResponsable;
	}

	/**
	 * @param string $codeEtape
	 */
	public function setCodeEtape($codeEtape)
	{
		$this->codeEtape = $codeEtape;
	}

	/**
	 * @return string
	 */
	public function getCodeEtape()
	{
		return $this->codeEtape;
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
	 * @param string $mailResponsable
	 */
	public function setMailResponsable($mailResponsable)
	{
		$this->mailResponsable = $mailResponsable;
	}

	/**
	 * @return string
	 */
	public function getMailResponsable()
	{
		return $this->mailResponsable;
	}

	/**
	 * @param string $responsable
	 */
	public function setResponsable($responsable)
	{
		$this->responsable = $responsable;
	}

	/**
	 * @return string
	 */
	public function getResponsable()
	{
		return $this->responsable;
	}

}
