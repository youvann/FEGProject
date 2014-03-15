<?php

/**
 * @Project: FEG Project
 * @File   : /Entities/CursusManager.php
 * @Purpose: Entité Cursus
 * @Author : Lionel Guissani
 */
class CursusManager
{
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db)
	{
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 *
	 * @param PDO $db
	 */
	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	/**
	 * Retourne les cursus d'un dossier étudiant
	 *
	 * @param Dossier $dossier Dossier étudiant
	 *
	 * @return array Cursus d'un dossier étudiant
	 */
	public function findAllByDossier(Dossier $dossier)
	{
		$lesCursus = array();
		$q = $this->db->prepare("SELECT * FROM `cursus` WHERE `cursus`.`ID_ETUDIANT` = ? AND `cursus`.`CODE_FORMATION` = ?;");
		$q->execute(array($dossier->getIdEtudiant(), $dossier->getCodeFormation()));
		$rs = $q->fetchAll();

		foreach ($rs as $cursus) {
			$lesCursus[] = new Cursus($cursus['ID'], $cursus['ID_ETUDIANT'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['NOTE'], $cursus['VALIDE']);
		}
		return $lesCursus;
	}

	/**
	 * Retourne les cursus d'un dossier étudiant ordonnés par année
	 *
	 * @param Dossier $dossier Dossier étudiant
	 *
	 * @return array Cursus d'un dossier étudiant ordonnés par année
	 */
	public function findAllByDossierOrderedByAnneeFin(Dossier $dossier)
	{
		$lesCursus = array();
		$q = $this->db->prepare("SELECT * FROM `cursus` WHERE `cursus`.`ID_ETUDIANT` = ? AND `cursus`.`CODE_FORMATION` = ? ORDER BY `cursus`.`ANNEE_FIN` DESC;");
		$q->execute(array($dossier->getIdEtudiant(), $dossier->getCodeFormation()));
		$rs = $q->fetchAll();

		foreach ($rs as $cursus) {
			$lesCursus[] = new Cursus($cursus['ID'], $cursus['ID_ETUDIANT'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['NOTE'], $cursus['VALIDE']);
		}
		return $lesCursus;
	}

	/**
	 * Retourne le dernier diplôme renseigné dans le dossier passé en paramètre
	 *
	 * @param Dossier $dossier Dossier étudiant
	 *
	 * @return string Le dernier diplôme renseigné dans le dossier
	 */
	public function findLastDiplomaObtainedByDossier(Dossier $dossier)
	{
		$q = $this->db->prepare("SELECT IF(count(*) > 0,
									(SELECT `CURSUS`
										FROM `cursus` c1
									WHERE c1.`ID_ETUDIANT` = ?
									AND c1.`VALIDE` = 1
									AND c1.`ANNEE_FIN` =
									(SELECT MAX(`ANNEE_FIN`) FROM `cursus` c2 WHERE c2.`ID_ETUDIANT` = ? AND `VALIDE` = 1)),
									(SELECT CONCAT('Bac : ', d1.`SERIE_BAC`)
										FROM `dossier` d1
									WHERE d1.`ID_ETUDIANT` = d.`ID_ETUDIANT`)
									) as DERNIER_DIPLOME
									FROM `dossier` d
										INNER JOIN `cursus` c ON (d.`ID_ETUDIANT` = c.`ID_ETUDIANT`)
								WHERE d.`ID_ETUDIANT` = ?
								AND c.`VALIDE` = 1;");
		$q->execute(array($dossier->getIdEtudiant()));
		$rs = $q->fetch();
		return $rs['DERNIER_DIPLOME'];
	}

	/**
	 * Enregistre un Cursus
	 *
	 * @param Cursus $cursus
	 *
	 * @return bool Résultat de l'opération
	 */
	public function insert(Cursus $cursus)
	{
		return $this->db->prepare("INSERT INTO `cursus` (`ID_ETUDIANT`, `CODE_FORMATION`, `ANNEE_DEBUT`, `ANNEE_FIN`, `CURSUS`, `ETABLISSEMENT`, `NOTE`, `VALIDE`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")
			->execute(array(
				$cursus->getIdEtudiant(),
				$cursus->getCodeFormation(),
				$cursus->getAnneeDebut(),
				$cursus->getAnneeFin(),
				$cursus->getCursus(),
				$cursus->getEtablissement(),
				$cursus->getNote(),
				$cursus->getValide()
			));
	}

	/**
	 * Supprime un Cursus
	 *
	 * @param Cursus $cursus
	 *
	 * @return bool Résultat de l'opération
	 */
	public function delete(Cursus $cursus)
	{
		return $this->db->prepare("DELETE FROM `cursus` WHERE `cursus`.`INE` = ? AND `cursus`.`CODE_FORMATION` = ?;")
			->execute(array(
				$cursus->getId(),
				$cursus->getCodeFormation()
			));
	}
}
