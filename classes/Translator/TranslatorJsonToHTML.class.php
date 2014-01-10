<?php

class TranslatorJsonToHTML extends Translator {
	public function translate($json, $structure) {
		$json = (array) json_decode($json);
		$keys = array_keys($json);
		var_dump($keys);
		for ($i = 0; $i < count($structure); ++$i) {
			switch ($structure[$i][2]) {
				case "TextBox": echo $this->textBoxJsonToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "TextArea": echo $this->textAreaJsonToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "CheckBox": echo $this->checkBoxJsonToHTML($json[$keys[$i]], $structure[$i][1]); break;
				case "CheckBoxGroup": echo $this->checkBoxGroupJsonToHTML($json[$keys[$i]], $structure[$i][1], $structure[$i][3]); break;
				case "RadioButtonGroup": echo $this->radioButtonGroupJsonToHTML($json[$keys[$i]], $structure[$i][1]); break;
			default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">'.$structure[$i][2].'</span></div>'; break;
			}
		}
	}
	
	//==================
	// Méthodes privées
	//==================

	private function textBoxJsonToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}

	private function textAreaJsonToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}
	
	private function checkBoxGroupJsonToHTML($datas, $label, $labels) {
		$return = $label . " : ";
		for ($i = 0; $i < count($datas); ++$i) {
			$return .= $this->checkBoxJsonToHTML($datas[$i], $labels[$i]);
		}
		return $return;
	}

	private function checkBoxJsonToHTML($data, $label) {
		/*$return = $label . " : ";
		if ($data === "true") {
			$return .= "Oui";
		} else if ($data === "false") {
			$return .= "Non";
		}
		return $return . "<br />";*/
		return $label . " : " . $data . '<br />';
	}
	
	private function radioButtonGroupJsonToHTML($data, $label) {
		return $label . " : " . $data . "<br />";
	}

	
}
