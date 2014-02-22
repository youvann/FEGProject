<?php

class SeDerouler {
	private $id;
	private $codeEtape;
	private $responsable;
	private $mailResponsable;

	
	function __construct($id, $codeEtape, $responsable, $mailResponsable) {
		$this->id = $id;
		$this->codeEtape = $codeEtape;
		$this->responsable = $responsable;
		$this->mailResponsable = $mailResponsable;
	}

	public function getId() {
		return $this->id;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setResponsable($responsable)
	{
		$this->responsable = $responsable;
	}

	public function getResponsable()
	{
		return $this->responsable;
	}

	public function setMailResponsable($mailResponsable)
	{
		$this->mailResponsable = $mailResponsable;
	}

	public function getMailResponsable()
	{
		return $this->mailResponsable;
	}


}
