<?php
// CHECK
class PieceAJoindreManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($libelPiece, $codeEtape, $codeVet) {
		$rs = $this->db->prepare("SELECT * FROM `PIECE_A_JOINDRE` WHERE `LIBEL_PIECE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($libelPiece, $codeEtape, $codeVet))->fetch();
		return new PieceAJoindre($rs['LIBEL_PIECE'], $rs['CODE_ETAPE'], $rs['CODE_VET)']);
	}

	public function findByFormation($codeEtape, $codeVet) {
		$piecesAJoindre = array();
		$rs = $this->db->prepare("SELECT * FROM `PIECE_A_JOINDRE` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($codeEtape, $codeVet))->fetchAll();
		foreach ($rs as $formation) {
			$piecesAJoindre[] = new PieceAJoindre($formation['LIBEL_PIECE'], $formation['CODE_ETAPE'], $formation['CODE_VET)']);
		}
		return $piecesAJoindre;
	}

	public function findAll() {
		$piecesAJoindre = array();
		$rs = $this->db->query("SELECT * FROM `PIECE_A_JOINDRE`;");
		foreach ($rs as $formation) {
			$piecesAJoindre[] = new PieceAJoindre($formation['LIBEL_PIECE'], $formation['CODE_ETAPE'], $formation['CODE_VET)']);
		}
		return $piecesAJoindre;
	}

	public function insert(PieceAJoindre $pieceAJoindre) {
		return $this->db->prepare("INSERT INTO `piece_a_joindre` (`LIBEL_PIECE`, `CODE_ETAPE`, `CODE_VET`) VALUES (?, ?, ?);")
						->execute(array(
							$pieceAJoindre->getLibelPiece(), 
							$pieceAJoindre->getCodeEtape(), 
							$pieceAJoindre->getCodeVet()
		));
	}

	public function update(PieceAJoindre $pieceAJoindre) {
		return $this->db->prepare("UPDATE `PIECE_A_JOINDRE` SET `LIBEL_PIECE` = ? WHERE `LIBEL_PIECE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array(
							$pieceAJoindre->getLibelPiece(), 
							$pieceAJoindre->getLibelPiece(), 
							$pieceAJoindre->getCodeEtape(), 
							$pieceAJoindre->getCodeVet()
		));
	}

	public function delete(PieceAJoindre $pieceAJoindre) {
		return $this->db->prepare("DELETE FROM `PIECE_A_JOINDRE` WHERE `LIBEL_PIECE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array(
							$pieceAJoindre->getLibelPiece(), 
							$pieceAJoindre->getCodeEtape(), 
							$pieceAJoindre->getCodeVet()
		));
	}

}
