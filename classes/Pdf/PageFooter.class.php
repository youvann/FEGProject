<?php 
/* 
 * @Project: FEG Project
 * @File: /classes/Pdf/PageFooter.class.php
 * @Purpose: Footer du PDF
 * @Author: 
 */

class PageFooter {
	private $footerText;

	public function __construct($footerText){
		$this->footerText = $footerText;
	}

	public function setFooterText($footerText){
		$this->footerText = $footerText;
	}

	public function __toString (){
		return ' <page_footer> 
			        ' . $this->footerText . ' 
			    </page_footer> ';
	}

}

?>