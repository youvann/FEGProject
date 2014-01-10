<?php 
/* 
 * @Project: FEG Project
 * @File: /classes/Pdf/Page.class.php
 * @Purpose: Construit la page d'un document HTML qui va être transformé en PDF
 * @Author: 
 */

class Page{
	private $backTop;
	private $backBottom;
	private $backLeft;
	private $backRight;
	private $cssPath;
	private $css;

	private $title1;
	private $title2;
	private $title3;
	private $title4;

	// Titulaire
	private $holder1;
	private $holder2;
	private $holder3;
	private $note;

	public function __construct($backTop = "30mm", $backBottom = "7mm", $backLeft = "0mm", $backRight = "10mm", $cssPath) {
		$this->backTop    = $backTop;
		$this->backBottom = $backBottom;
		$this->backLeft   = $backLeft;
		$this->backRight  = $backRight;
		$this->cssPath    = $cssPath;
		$this->css = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
	}
		
	public function getBegin(){
		echo '<page backtop="' . $this->backTop . '" backbottom="' . $this->backBottom . '" backleft="' . $this->backLeft . '" backright="' . $this->backRight . '"> ';
	}

	// public function getEnd (){
	// 	echo "</page> ";
	// }

	public function getCssPath (){
		echo $this->css;
	}

	public function setCssPath ($cssPath){
		$this->cssPath = $cssPath;
		$this->css = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
	}	

	public function setTitle1 ($title1){
		$this->title1 = $title1;
	}	

	public function setTitle2 ($title2){
		$this->title2 = $title2;
	}

	public function setTitle3 ($title3){
		$this->title3 = $title3;
	}

	public function setTitle4 ($title4){
		$this->title4 = $title4;
	}

	public function setHolder1 ($holder1){
		$this->holder1 = $holder1;
	}

	public function setHolder2 ($holder2){
		$this->holder2 = $holder2;
	}

	public function setHolder3 ($holder3){
		$this->holder3 = $holder3;
	}

	public function setNote ($note){
		$this->note = $note;
	}

	public function getFormationTitle(){
		echo '<table class="t_title">
		        <tr>
		            <td colspan="2" class="full_width_table titre3 bold">' . $this->title1 . '</td>
		        </tr>
		        <tr>
		            <td colspan="2" class="full_width_table titre1 bold">' . $this->title2 . '</td>
		        </tr>
		        <tr>
		            <td class="fifty_width_table border-top-none border-right-none titre2 bold" text-align="center">' . $this->title3 . '</td>
		            <td class="fifty_width_table border-top-none titre2 bold"><img src="./img/miage.png" alt=""></td>
		        </tr>
		        <tr>
		            <td class="titre4 bold" colspan="2">' . $this->title4 . '</td>
		        </tr>
		    </table>';
	}

	public function degreeHolder(){
		echo '<br><form action="">
		        <input type="checkbox" value="titulaire1"><span class="bold note">' . $this->holder1 . '</span><br>
		        <input type="checkbox" value="titulaire2"><span class="bold note">' . $this->holder2 . '</span><br>
		        <input type="checkbox" value="titulaire3"><span class="bold note">' . $this->holder3 . '</span><br>
		    </form>
		    <p class="note">' . $this->note . '</p>';
	}

	public function __toString (){
		return $this->getCssPath() . $this->getBegin() . $this->getFormationTitle() . $this->degreeHolder();
	}
}

?>