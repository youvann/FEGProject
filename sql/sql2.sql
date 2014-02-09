SELECT `information_supp`.`id` as idInfo, `information_supp`.`libelle` as libelleInfo, `type_formelement`.`nom` as typeInfo, `libelle_info`.`contenu` as libellesInfo
FROM `information_supp` 
	INNER JOIN `type_formelement` ON (`information_supp`.`type` = `type_formelement`.`id`)
	LEFT JOIN `libelle_info` ON (`information_supp`.`id` = `libelle_info`.`info`)
ORDER BY `information_supp`.`ordre`;

UPDATE `information_supp` SET `ordre` = 1 WHERE `id` = 'i1';
UPDATE `information_supp` SET `ordre` = 2 WHERE `id` = 'i2';
UPDATE `information_supp` SET `ordre` = 3 WHERE `id` = 'i3';
UPDATE `information_supp` SET `ordre` = 4 WHERE `id` = 'i4';
UPDATE `information_supp` SET `ordre` = 5 WHERE `id` = 'i5';
UPDATE `information_supp` SET `ordre` = 6 WHERE `id` = 'i6';

# RESET
DROP TABLE `libelle_info`;
DROP TABLE `information_supp`;
DROP TABLE `type_formelement`;

CREATE TABLE `type_formelement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; #latin1

CREATE TABLE `information_supp` (
  `id` varchar(5) NOT NULL,
  `libelle` varchar(45) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_idx` (`type`),
  CONSTRAINT `type` FOREIGN KEY (`type`) REFERENCES `type_formelement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8; #latin1;

CREATE TABLE `libelle_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(128) NOT NULL,
  `info` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `libelle_idx` (`info`),
  CONSTRAINT `libelle` FOREIGN KEY (`info`) REFERENCES `information_supp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8; #latin1;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` TRIGGER generate_id_info_supp BEFORE INSERT ON `test`.`information_supp`
FOR EACH ROW
BEGIN
	DECLARE idInfo INTEGER;
	SELECT MAX(CAST(RIGHT(`information_supp`.`id`, LENGTH(`information_supp`.`id`) - 1) as UNSIGNED)) 
		INTO idInfo 
		FROM `information_supp`;
	IF idInfo <=> NULL THEN
		SET new.id = ('i1');
	ELSE
		SET idInfo = idInfo + 1;
		SET new.id = CONCAT('i', idInfo);
	END IF;
END$$

DELIMITER ;

INSERT INTO `test`.`type_formelement` (`nom`) VALUES
('TextBox'),('TextArea'),('CheckBox'),('CheckBoxGroup'),('RadioButtonGroup');

INSERT INTO `test`.`information_supp` (`libelle`, `type`) VALUES
('Nom', 1),  
('Quelles sont vos motivations ?', 2),
('Exercez-vous une profession en plus des études ?', 3),
('Parmi ces langages, indiquez ceux que vous maîtrisez', 4),
('Prénom', 1),
('Quel est le système d\'exploitation que vous utilisez ?', 5);

SELECT * FROM `information_supp` 
	INNER JOIN `type_formelement` ON (`information_supp`.`type` = `type_formelement`.`id`);

INSERT INTO `test`.`libelle_info` (`contenu`, `info`) VALUES
('Php', 'i4'),('C#', 'i4'),('Java', 'i4'),('C++', 'i4'),
('Windows', 'i6'),('Unix', 'i6'),('Max OS', 'i6'),('Solaris', 'i6');



SELECT IF(COUNT(*) > 0, 'Pré-inscription', 'Candidature')
FROM `test`.`dependre` 
WHERE `ID_MERE` = 5
AND `ID_FILLE` = 2; # un mec en L3 Informatique nouvelles technologies postule en Master MIAGE

SELECT IF(COUNT(*) > 0, 'Pré-inscription', 'Candidature')
FROM `test`.`dependre` 
WHERE `ID_MERE` = 5
AND `ID_FILLE` = 3; # un mec en L3 MIAGE postule en Master MIAGE

SELECT * FROM `test`.`formation` ;

SELECT * FROM `test`.`dependre` ;
