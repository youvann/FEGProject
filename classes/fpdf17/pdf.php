<?php
require('fpdf.php');
header('Content-Type: text/html; charset=utf-8');

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,"ééé");
	$pdf->Output();
?>