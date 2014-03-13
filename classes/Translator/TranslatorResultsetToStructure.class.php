<?php

/**
 * @Project: FEG Project
 * @File: /classes/Translator/TranslatorResulsetToStructure.class.php
 * @Purpose: Cette classe a pour rôle de traduire le résultat de la 
 * requête demandant les informations supplémentaires en tableau PHP.
 * @Author: Lionel Guissani
 */
class TranslatorResulsetToStructure {

	/**
	 * Traduire le résultat de la requête demandant 
	 * les informations supplémentaires en tableau PHP.
	 * @param PDOStatement $rs Résultat de la requête
	 * @return array Structure des informations supplémentaires
	 */
	public function translate($rs) {
		$structure = array();

		$i = 0;
		while ($i < count($rs)) {
			$array = array();
			$array[] = $rs[$i]['idInfo'];
			$array[] = $rs[$i]['libelleInfo'];
			$array[] = $rs[$i]['typeInfo'];
			if ($rs[$i]['typeInfo'] == 'CheckBoxGroup' || $rs[$i]['typeInfo'] == 'RadioButtonGroup') {
				$idInfo = $rs[$i]['idInfo'];
				$libellesInfo = array();
				while ($i < count($rs) && $rs[$i]['idInfo'] === $idInfo) {
					$libellesInfo[] = $rs[$i]['libellesInfo'];
					++$i;
				}
				$array[] = $libellesInfo;
				$i = $i - 1;
			}
			++$i;
			$structure[] = $array;
		}
		return $structure;
	}
}
