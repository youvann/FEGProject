<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Formation.php
 * @Purpose: Entité Formation
 * @Author: Lionel Guissani
 */
class Formation {
	/**
	 * @var string Code formation
	 */
	private $codeFormation;
	/**
	 * @var string Mention
	 */
	private $mention;
	/**
	 * @var string Faculté
	 */
	private $faculte;

	/**
	 * @param $codeFormation string Code formation
	 * @param $mention string Mention
	 * @param $faculte string Faculté
	 */
	function __construct($codeFormation, $mention, $faculte) {
		$this->codeFormation = $codeFormation;
		$this->mention = $mention;
		$this->faculte = $faculte;
	}

	/**
	 * @param string $codeFormation
	 */
	public function setCodeFormation($codeFormation)
	{
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @return string
	 */
	public function getCodeFormation()
	{
		return $this->codeFormation;
	}

	/**
	 * @param string $faculte
	 */
	public function setFaculte($faculte)
	{
		$this->faculte = $faculte;
	}

	/**
	 * @return string
	 */
	public function getFaculte()
	{
		return $this->faculte;
	}

	/**
	 * @param string $mention
	 */
	public function setMention($mention)
	{
		$this->mention = $mention;
	}

	/**
	 * @return string
	 */
	public function getMention()
	{
		return $this->mention;
	}
}
