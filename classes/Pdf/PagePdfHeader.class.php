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
        
        /*
	public function __construct($imgPath, $headerText){
		$this->imgPath    = $imgPath;
		$this->headerText = $headerText;
	}*/

	public function setImgPath ($imgPath){
		$this->imgPath = $imgPath;
	}

	public function setHeadertext ($headerText){
		$this->headerText = $headerText;
	}

	public function __toString (){
		return '<page_header> 
			        
			            <div>
			                <span class="t_header"><img src="' . $this->imgPath . '" alt="image"></span>
			                <span class="bold titre4, t_header" style="text-align:right;">' . $this->headerText .'</span><br/>
                                    </div>
			</page_header> ';
	}

}

/*


			        <table class="t_header">
			            <tr>
			                <td><img src="' . $this->imgPath . '" alt="image"></td>
			                <td class="bold titre4">' . $this->headerText .'</td>
			            </tr>
			        </table>

*/

?>