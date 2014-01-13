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
	 * @param PDOStatement $resultset
	 * @return array Structure des informations supplémentaires
	 */
	public function translate(PDOStatement $resultset) {
		$structure = array();

		$i = 0;
		while ($i < count($resultset)) {
			$array = array();
			$array[] = $resultset[$i]['idInfo'];
			$array[] = $resultset[$i]['libelleInfo'];
			$array[] = $resultset[$i]['typeInfo'];
			if ($resultset[$i]['typeInfo'] == 'CheckBoxGroup' || $rs[$i]['typeInfo'] == 'RadioButtonGroup') {
				$idInfo = $rs[$i]['idInfo'];
				$libellesInfo = array();
				while ($i < count($resultset) && $resultset[$i]['idInfo'] === $idInfo) {
					$libellesInfo[] = $resultset[$i]['libellesInfo'];
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
