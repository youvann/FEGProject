<?php


class TranslatorResulsetToStructure {
	/**
	 * 
	 * @param PDOStatement $resultset
	 * @return array
	 */
	public function translate(PDOStatement $resultset) {
		return array('un' => 'toto');
	}

	//==================
	// Méthodes privées
	//==================

	private function textBoxResulsetToStructure() {
		return;
	}

	private function textAreaResulsetToStructure() {
		return;
	}
	
	private function checkBoxGroupResulsetToStructure() {
		return;
	}

	private function checkBoxResulsetToStructure() {
		return ;
	}
	
	private function radioButtonGroupResulsetToStructure() {
		return;
	}
}
