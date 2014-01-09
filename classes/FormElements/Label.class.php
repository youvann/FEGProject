<?php

class Label {
	private $for;
	private $label;

	function __construct($for, $label) {
		$this->for = $for;
		$this->label = $label;
	}

		public function __toString() {
		return '<label for="' . $this->for . '">' . $this->label . '</label>';
	}

	public function getFor() {
		return $this->for;
	}

	public function getLabel() {
		return $this->label;
	}

	public function setFor($for) {
		$this->for = $for;
	}

	public function setLabel($label) {
		$this->label = $label;
	}
}