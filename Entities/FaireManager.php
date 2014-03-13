<?php
/**
 * @Project: FEG Project
 * @File: /Entities/FaireManager.php
 * @Purpose: Entité Faire
 * @Author: Lionel Guissani
 */
class FaireManager {
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db) {
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 * @param PDO $db
	 */
	public function setDb(PDO $db) {
		$this->db = $db;
	}

	/**
	 * Retourne les souhaits de l'étudiant
	 * @param Dossier $dossier Dossier étudiant
	 * @return array Souhaits
	 */
	public function findAllByDossier(Dossier $dossier) {
		$faires = array();
		$q = $this->db->prepare("SELECT * FROM `faire` WHERE `ID_ETUDIANT` = ? AND `CODE_FORMATION` = ? ORDER BY `ORDRE`;");
        $q->execute(array($dossier->getIdEtudiant(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();

		foreach ($rs as $faire) {
			$faires[] = new Faire($faire['CODE_ETAPE'], $faire['ID_ETUDIANT'], $faire['CODE_FORMATION'], $faire['ORDRE']);
		}
		return $faires;
	}

	/**
	 * Enregistre le fait qu'un étudiant fasse un voeu pour une spécialité
	 * @param Faire $faire fait qu'un étudiant fasse un voeu pour une spécialité
	 * @return bool Résultat de l'opération
	 */
	public function insert(Faire $faire) {
		return $this->db->prepare("INSERT INTO `faire` (`CODE_ETAPE`, `ID_ETUDIANT`, `CODE_FORMATION`, `ORDRE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$faire->getCodeEtape(),
							$faire->getIdEtudiant(),
							$faire->getCodeFormation(),
							$faire->getOrdre()
		));
	}

	/**
	 * Supprime le fait qu'un étudiant fasse un voeu pour une spécialité
	 * @param Faire $faire fait qu'un étudiant fasse un voeu pour une spécialité
	 * @return bool Résultat de l'opération
	 */
	public function delete(Faire $faire) {
		return $this->db->prepare("DELETE FROM `faire` WHERE `CODE_ETAPE` = ? AND `ID_ETUDIANT` = ?;")
						->execute(array(
							$faire->CodeEtape(),
							$faire->Ine()
		));
	}

}
