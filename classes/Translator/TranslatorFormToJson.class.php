<?php

class TranslatorFormToJson extends Translator {

	public function translate($structure, $post) {
		$keys = array_keys($post);
		$json = array();
		$j = 0;
		for ($i = 0; $i < count($structure); ++$i) {
			switch ($structure[$i][2]) {
				case "TextBox": $json[] = $this->textBoxPostToJson($structure[$i][0], $post[$keys[$j]]);
					break;
				case "TextArea": $json[] = $this->textAreaPostToJson($structure[$i][0], $post[$keys[$j]]);
					break;
				case "CheckBox": {
						$json[] = $this->checkBoxPostToJson($structure[$i][0], $post[$keys[$j]] === ("elem-" . $i));
						if ($post[$keys[$j]] !== ("elem-" . $i)) {
							--$j;
						}
					}
					break;
				case "CheckBoxGroup": //$this->checkBoxGroupToForm();
					break;
				case "RadioButtonGroup": $json[] = $this->radioButtonGroupPostToJson($structure[$i][0], $post[$keys[$j]]);
					break;
				default: echo '<div class="alert alert-danger">Il y a un problème dans le script ' . __FILE__ . '.<br />La variable du switch vaut <span class="label label-danger">' . $structure[$i][1] . '</span></div>';
					break;	
			}
			++$j;
		}
		return json_encode($json);
	}

	public function textBoxPostToJson($idInfo, $post) {
		return array($idInfo => $post);
	}

	public function textAreaPostToJson($idInfo, $post) {
		return array($idInfo => $post);
	}

	public function checkBoxPostToJson($idInfo, $checked) {
		return array($idInfo => ($checked) ? 'true' : 'false');
	}

	public function checkBoxGroupPostToJson($post) {
		
	}

	public function radioButtonGroupPostToJson($idInfo, $post) {
		return array($idInfo => $post);
	}

}
