/* Select All */

select * from formation;

select * from candidat;

select * from candidature_voeux;

select * from pre_inscription;

select * from type_champs_informations;

select * from cursus_etudiant;

select * from information_supp;

select * from piece_a_joindre_specifique;

select * from piece_a_joindre_generale;

select * from libelle_information;


/* insert */

insert into formation (`MENTION`, `ETAPE`, `CODE_DIPLOME`, `CODE_ETAPE`, `CODE_VET`, `RESPONSABLE`, `VILLE`, `FACULTE`, `LANGUE_PDF`)
VALUES (?,?,?,?,?,?,?,?,?);

INSERT INTO `cursus_etudiant`
(`NUM_INE`,
`CURSUS_SUIVIT`,
`ANNEE`,
`ETABLISSEMENT`,
`VALIDE`,
`CODE_ETAPE`,
`CODE_VET`)
VALUES
(?, ?, ?, ?, ?, ?, ?);

INSERT INTO `pre_inscription`
(`CODE_ETAPE_MERE`,
`CODE_VET_MERE`,
`CODE_ETAPE_FILLE`,
`CODE_VET_FILLE`)
VALUES
( ?, ?, ?, ?);

INSERT INTO `information_supp`
(`CODE_ETAPE`, `CODE_VET`, `ID`, `LIBEL_INFORMATION`, `REQUIS`, `ID_TYPE_ELEMENT`)
VALUES (?, ?, ?, ?, ?, ?);

INSERT INTO `piece_a_joindre`
(`LIBEL_PIECE`,
`CODE_ETAPE`,
`CODE_VET`)
VALUES
( ?, ?, ?);

INSERT INTO `piece_a_joindre_generale`
(`ID`,
`LIBEL_PIECE`)
VALUES
( ?, ?);

INSERT INTO `type_champs_informations`
(`ID`,
`NOM_TYPE`)
VALUES
( ?, ?);

INSERT INTO `candidature_voeux`
(`CODE_ETAPE_MERE`,
`CODE_VET_MERE`,
`CODE_ETAPE_FILLE`,
`CODE_VET_FILLE`)
VALUES
( ?, ?, ?, ?);

INSERT INTO `libelle_information`
(`ID`,
`LIBEL_INFORMATION`)
VALUES
( ?, ?);

insert information:

/*delete */

DELETE FROM `FORMATION` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ?;

DELETE FROM `candidat` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ? AND `NUM_INE` = ?;

DELETE FROM `candidature_voeux` WHERE `CODE_ETAPE_MERE` = ? AND `CODE_VET_MERE` = ? AND `CODE_ETAPE_FILLE` = ? AND `CODE_VET_FILLE` = ?;

DELETE FROM `pre_inscription` WHERE `CODE_ETAPE_MERE` = ? AND `CODE_VET_MERE` = ? AND CODE_ETAPE_FILLE =? AND CODE_VET_FILLE = ?;

DELETE FROM `cursus_etudiant` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ? AND `NUM_INE` = ?;

DELETE FROM `information_supp` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ? AND `NUM_INE` = ? AND `ID` = ?;

DELETE FROM `libelle_information` WHERE `ID` = ?;

DELETE FROM `piece_a_joindre_generale` WHERE `ID` = ?;

DELETE FROM `piece_a_joindre_specifique` WHERE `CODE_ETAPE` =? AND `CODE_VET` = ? and `LIBEL_PIECE` = ?;

DELETE FROM `type_champs_informations` WHERE `ID` = ?;

DELETE FROM TA_TABLE;  /* CA DELETE TOUTES LES LIGNES */



/* update */

UPDATE FORMATION SET `ETAPE` = ?, `MENTION` = ?, `CODE_DIPLOME` = ?, `CODE_ETAPE` = ?, `CODE_VET` = ?, `RESPONSABLE` = ?, `VILLE` = ?, `FACULTE` = ?, `LANGUE_PDF` = ? WHERE `CODE_ETAPE` = ? and `CODE_VET` = ?;

update piece_a_joindre_generale set ID = ?,  LIBEL_PIECE = ? where ID = ?;

UPDATE `PIECE_A_JOINDRE` SET `LIBEL_PIECE` = ? WHERE `LIBEL_PIECE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;

UPDATE information_supp
SET
`CODE_ETAPE` = ?,
`CODE_VET` = ?,
`ID` = ?,
`LIBEL_INFORMATION` = ?,
`REQUIS` = ?,
`ID_TYPE_ELEMENT` = ?
WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ? AND `ID` = ?;

UPDATE type_champs_informations
SET
`ID` = ?,
`NOM_TYPE` = ?
WHERE `ID` = ?;

UPDATE libelle_information
SET
`ID` = ?,
`LIBEL_INFORMATION` = ?
WHERE `ID` = ?;