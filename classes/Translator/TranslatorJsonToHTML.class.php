<?php

class TranslatorJsonToHTML extends Translator {
	public function translate($json, $structure) {
		$json = (array) json_decode($json, true);
		$html = '';
		for ($i = 0; $i < count($structure); ++$i) {
			
			switch ($structure[$i][2]) {
				case "TextBox": $html .= $this->textBoxJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				case "TextArea": $html .= $this->textAreaJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				case "CheckBox": $html .= $this->checkBoxJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
				case "CheckBoxGroup": $html .= $this->checkBoxGroupJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1], $structure[$i][3]); break;
				case "RadioButtonGroup": $html .= $this->radioButtonGroupJsonToHTML($json[$i], $structure[$i][0], $structure[$i][1]); break;
			default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">'.$structure[$i][2].'</span></div>'; break;
			}
		}
		return $html;
	}
	
	//==================
	// Méthodes privées
	//==================

	private function textBoxJsonToHTML($data, $idInfo, $label) {
		return $label . " : " . $data[$idInfo] . "<br />";
	}

	private function textAreaJsonToHTML($data, $idInfo, $label) {
		return $label . " : " . $data[$idInfo] . "<br />";
	}
	
	private function checkBoxJsonToHTML($data, $idInfo, $label) {
		return $label . " : " . $data[$idInfo] . '<br />';
	}
	
	private function checkBoxGroupJsonToHTML($datas, $idInfo, $label, $labels) {
		$return = $label . " : ";
		for ($i = 0; $i < count($datas[$idInfo]); ++$i) {
			$return .= $labels[$i] . ' : ' . $datas[$idInfo][$i] . ($i === count($datas[$idInfo]) - 1 ? '.<br />' : ', ');
		}
		return $return;
	}
	
	private function radioButtonGroupJsonToHTML($data, $idInfo, $label) {
		return $label . " : " . $data[$idInfo] . '<br />';
	}
}
