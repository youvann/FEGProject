<?php
/*
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdfHeader.class.php
 * @Purpose: Header du PDF
 * @Author:
 */

class PagePdfHeader {
	private $imgPath;
	private $headerText;
        
        
	public function __construct(){
		
            
	}

	public function setImgPath ($imgPath){
		$this->imgPath = $imgPath;
	}
       

	public function setHeadertext ($headerText){
		$this->headerText = $headerText;
	}

	public function __toString (){
		return '<page_header> 
			        <span class="t_header"><img src="' . $this->imgPath . '" alt="image"></span>	        
			    </page_header> ';
	}

}

?>