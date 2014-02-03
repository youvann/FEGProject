<?php

class Form {
	private $elements = array();
}

class FormElement {

}

class TextBox extends FormElement {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<input type="text" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}
}

class CheckBox extends FormElement {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<input type="checkbox" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}
}

class TextArea extends FormElement {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<textarea id="' . $this->id . '" name="' . $this->name . '">' . $this->value . '</textarea>';
	}
}

class Select extends FormElement {
	private $id;
	private $name;
	private $options;
	private $multiple;

	public function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
		$this->options = array();
	}

	public function addOption(Option $option) {
		$this->options[] = $option;
	}

	public function __toString() {
		$return = '<select id="' . $this->id . '" name="' . $this->name . '" ' . ($thisd->multiple === true ? 'multiple="multiple"' : '') . ' >';
		foreach ($this->options as $option) {
			$return .= $option;
		}
		return $return . '</select>';
	}
}

class Option {
	private $label;
	private $value;

	public function __construct($label, $value) {
		$this->label = $label;
		$this->value = $value;
	}

	public function __toString() {
		return '<option value="' . $this->value . '">' . $this->label . '</option>';
	}
}


class RadioButton extends FormElement {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<input type="radio" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}
}

class File {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return;
	}	
}

class CheckBoxGroup extends FormElement {

	public function __toString() {
		return;
	}
	
}

class RadioButtonGroup extends FormElement {
	
	public function __toString() {

	}
}

$textbox = new TextBox("tb","tb","");
$textarea = new TextArea("ta","ta","");
$checkbox = new CheckBox("cb","cb","");

$select= new Select("se", "se");
$select->addOption(new Option("Un", 1));
$select->addOption(new Option("Deux", 2));
$select->addOption(new Option("Trois", 3));



echo $textbox;
echo $textarea;
echo $checkbox;

echo $select;