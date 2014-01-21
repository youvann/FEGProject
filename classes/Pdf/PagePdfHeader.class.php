<?php
/*
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdfHeader.class.php
 * @Purpose: Header du PDF
 * @Author:
 */

class PagePdfHeader {
	private $imgPath;
        private $imgPath2;
	private $headerText;
        
        /*
	public function __construct($imgPath, $headerText){
		$this->imgPath    = $imgPath;
		$this->headerText = $headerText;
	}*/

	public function setImgPath ($imgPath, $imgPath2){
		$this->imgPath = $imgPath;
                $this->imgPath2 = $imgPath2;
	}
        

	public function setHeadertext ($headerText){
		$this->headerText = $headerText;
	}

	public function __toString (){
		return '<page_header> 
			        <span class="t_header"><img src="' . $this->imgPath . '" alt="image"></span>
                                <span class="t_header text_align" ><img src="' . $this->imgPath2 . '" alt="image"></span>
			        
			    </page_header> ';
	}

}

?>