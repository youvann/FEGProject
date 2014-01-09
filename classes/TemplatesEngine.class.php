<?php

class TemplatesEngine {

	public function render($viewName, $vars) {
		
		var_dump($vars);
		
		ob_start(array('TemplatesEngine', 'engine'));

		include_once './views/' . $viewName . '.php';

		ob_end_flush();
	}

	private function engine($buffer) {
		return $buffer;
	}

}
