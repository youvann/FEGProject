<?php

class FaireManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}
	
	public function find();
	
	public function insert(Faire $faire);
	
	public function delete(Faire $faire);
}
