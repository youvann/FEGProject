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
				case "CheckBoxGroup": {
						// Si elem-4 existe
						var_dump("elem-".($j+1));
						if (array_key_exists("elem-".($j+1), $post)) {
							$json[] = $this->checkBoxGroupPostToJson($structure[$i][0], $post[$keys[$j]], $structure[$i][3]);
						} else {
							$json[] = $this->checkBoxGroupPostToJsonNo($structure[$i][0], $structure[$i][3]);
							--$j;
						}
					}
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
		return array($idInfo => ($checked) ? 'Oui' : 'Non');
	}

	public function checkBoxGroupPostToJson($idInfo, $post, $labels) {
		$res = array();
		for ($i = 0; $i < count($labels); ++$i) {
			$res[] = in_array($labels[$i], $post) ? 'Oui' : 'Non';
		}
		return array($idInfo => $res);
	}

	public function checkBoxGroupPostToJsonNo($idInfo, $labels) {
		$res = array();
		for ($i = 0; $i < count($labels); ++$i) {
			$res[] = 'Non';
		}
		return array($idInfo => $res);
	}

	public function radioButtonGroupPostToJson($idInfo, $post) {
		return array($idInfo => $post);
	}

}
