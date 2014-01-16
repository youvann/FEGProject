<?php

class PieceAJoindreGeneraleManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$rs = $this->db->prepare("SELECT * FROM `PIECE_A_JOINDRE_GENERALE` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new PieceAJoindreGenerale($rs['ID'], $rs['LIBEL_PIECE']);
	}

	public function findAll() {
		$piecesAJoindreGenerale = array();
		$rs = $this->db->query("SELECT * FROM `PIECE_A_JOINDRE_GENERALE`;")->fetchAll();
		foreach ($rs as $pieceAJoindreGenerale) {
			$piecesAJoindreGenerale[] = new PieceAJoindreGenerale($pieceAJoindreGenerale['ID'], $pieceAJoindreGenerale['LIBEL_PIECE']);
		}
		return $piecesAJoindreGenerale;
	}

	public function insert(PieceAJoindreGenerale $pieceAJoindreGenerale) {
		return $this->db->prepare("INSERT INTO `PIECE_A_JOINDRE_GENERALE` (`LIBEL_PIECE`) VALUES (?);")
						->execute(array($pieceAJoindreGenerale->getLibelPiece()));
	}

	public function update(PieceAJoindreGenerale $pieceAJoindreGenerale) {
		return $this->db->prepare("UPDATE `PIECE_A_JOINDRE_GENERALE` SET `LIBEL_PIECE` = ? WHERE `ID` = ?;")
						->execute(array(
							$pieceAJoindreGenerale->getLibelPiece(),
							$pieceAJoindreGenerale->getId()
		));
	}

	public function delete(PieceAJoindreGenerale $pieceAJoindreGenerale) {
		return $this->db->prepare("DELETE FROM `PIECE_A_JOINDRE_GENERALE` WHERE `ID` = ?;")
						->execute(array($pieceAJoindreGenerale->getId()));
	}

}
