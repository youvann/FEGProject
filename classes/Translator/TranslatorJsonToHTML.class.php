<?php

class TranslatorJsonToHTML extends Translator {
	public function translate($json, $structure) {
		$json = (array) json_decode($json);
		$keys = array_keys($json);
		var_dump($keys);
		for ($i = 0; $i < count($structure); ++$i) {
			switch ($structure[$i][2]) {
				case "TextBox": echo $this->textBoxToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "TextArea": echo $this->textAreaToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "CheckBox": echo $this->checkBoxToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "CheckBoxGroup": echo $this->checkBoxGroupToHTML($json[$keys[$i]], $structure[$i][1], $structure[$i][3]); break;
				case "RadioButtonGroup": echo $this->radioButtonGroupToHTML($json[$keys[$i]], $structure[$i][1]); break;
			default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">'.$structure[$i][2].'</span></div>'; break;
			}
		}
	}
	
	//==================
	// Méthodes privées
	//==================

	private function textBoxToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}

	private function textAreaToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}
	
	private function checkBoxGroupToHTML($datas, $label, $labels) {
		$return = $label . " : ";
		for ($i = 0; $i < count($datas); ++$i) {
			$return .= $this->checkBoxToHTML($datas[$i], $labels[$i]);
		}
		return $return;
	}

	private function checkBoxToHTML($data, $label) {
		$return = $label . " : ";
		if ($data === "true") {
			$return .= "Oui";
		} else if ($data === "false") {
			$return .= "Non";
		}
		return $return . "<br />";
	}
	
	private function radioButtonGroupToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}

	
}
