<?php

/**
 * Cette classe contient des methodes qui retourne chacune une entete
 * specifique pour type de fichier à rendre au navigateur.
 * Toutes les méthodes de cette classe sont statiques.
 */
class FileHeader {
	/**
	 * Créé une entete pour fichiers CSS
	 */
	public static function headerCss() {
		header("Content-type: text/css");
	}
	
	/**
	 * Créé une entete pour fichiers CSV
	 */
	public static function headerCsv() {
		header("Content-type: application/vnd.ms-excel");
	}

	/**
	 * Créé une entete pour fichiers Word
	 */
	public static function headerDoc() {
		header("Content-Type: application/msword");
	}

	/**
	 * Créé une entete pour images GIF
	 */
	public static function headerGif() {
		header("Content-Type: image/gif");
	}

	/**
	 * Créé une entete pour images JPG
	 */
	public static function headerJpg() {
		header("Content-Type: image/jpg");
	}

	/**
	 * Créé une entete pour fichiers JSON
	 */
	public static function headerJson() {
		header('Content-type: application/json');
	}

	/**
	 * Créé une entete pour fichiers PDF
	 */
	public static function headerPdf() {
		header("Content-Type: application/pdf");
	}

	/**
	 * Créé une entete pour images PNG
	 */
	public static function headerPng() {
		header("Content-Type: image/png");
	}

	/**
	 * Créé une entete pour fichiers Powerpoint
	 */
	public static function headerPpt() {
		header("Content-Type: application/vnd.ms-powerpoint");
	}

	/**
	 * Créé une entete pour fichiers texte brut
	 */
	public static function headerTextPlain() {
		header("Content-Type: text/plain");
	}

	/**
	 * Créé une entete pour fichiers Excel
	 */
	public static function headerXls() {
		header("Content-Type: application/vnd.ms-excel");
	}

	/**
	 * Créé une entete pour fichiers XML
	 */
	public static function headerXml() {
		header("Content-Type:text/xml");
	}

	/**
	 * Créé une entete pour archives ZIP
	 */
	public static function headerZip() {
		header("Content-Type: application/zip");
	}
}
