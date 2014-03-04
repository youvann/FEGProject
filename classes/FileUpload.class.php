<?php
/* Préambule 
 *
 * Les extensions php_mbstring.dll et php_exif.dll doivent être chargées dans php.ini
 * L'extension php_mbstring.dll doit être chargée avant l'extension php_exif.dll
 *
 * Exemple :
 * extension=php_mbstring.dll
 * extension=php_exif.dll
 * 
 * Dans php.ini, il faut activer l'upload de fichier :
 * file_uploads = On
 * 
 * Il faut définir le fichier temporaire :
 * upload_tmp_dir = "c:/wamp/tmp"
 * 
 * Il faut aussi définir la taille maximum d'un fichier à uploader
 * upload_max_filesize = 2M
 * 
 * 
 * 
 */

class FileUpload {

	//private static $_dossier = 'C:/wamp/www/supranova/img/';
	private static $dossier = './img/';
	private static $tailleMax = 8388608; // 8Mo (comme dans php.ini)
	private static $extensions = array('.png', '.gif', '.jpg', '.jpeg', 'zip', 'rar');

	// reçoit en paramètre la variable $_FILES
	public static function uploadFile($file) {
		$fichier = basename($file['name']);
		$taille = filesize($file['tmp_name']);
		$extension = strtolower(strrchr($file['name'], '.'));

		try {
			if ($file['error'] === UPLOAD_ERR_OK) {
				//Début des vérifications de sécurité...
				if (!in_array($extension, self::$extensions)) { //Si l'extension n'est pas dans le tableau
					$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.<br />';
				}
				if ($taille > self::$tailleMax) {
					$erreur .= 'Le fichier est trop gros.<br />';
				}
				if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
					// On formate le nom du fichier ici...
					//$fichier = self::formaterNomFichier($fichier);
					
					// On défini le nom du fichier comme la date courante exprimée en secondes
					$fichier = time().$extension;
					if (move_uploaded_file($file['tmp_name'], self::$dossier . $fichier)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
						echo 'Téléchargement effectué avec succès !';
					} else {
						return false;
					}
				} else {
					//echo $erreur;
					return false;
				}
			} else {
				throw new UploadException($file['error']);
			}
		} catch (UploadException $e) {
			echo $e->getMessage();
		}
		return $fichier;
	}

	private static function formaterNomFichier($fichier) {
		$trans = array('À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
			'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
			'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
			'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
			'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y',
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
			'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
			'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'ð' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
			'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
			'ý' => 'y', 'ÿ' => 'y');

		//On remplace les lettres accentutées par les non accentuées dans $fichier et on récupère le résultat dans fichier
		//$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$fichier = strtr($fichier, $trans);

		//On remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

		return $fichier;
	}

}

class ImageUpload {

	private static $_dossier = 'C:/wamp/www/assert/Img/';
	private static $_tailleMax = 2000000; // 2Mo (comme dans php.ini)
	private static $_extensions = array('.png', '.gif', '.jpg', '.jpeg');
	private static $_maxWidthImg = 200;
	private static $_maxHeightImg = 200;

	public static function UploadFile($file) {
		$fichier = basename($file['name']);
		$erreur = $file['error'];
		$taille = filesize($file['tmp_name']);
		$extension = strrchr($file['name'], '.');
		$img_size = getimagesize($_FILES['name']['tmp_name']);
		$widthImg = $img_size[0];
		$heightImg = $img_size[1];


		//Début des vérifications de sécurité...
		if (!in_array($extension, self::$_extensions)) { //Si l'extension n'est pas dans le tableau
			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.<br>';
		}
		if ($taille > self::$_tailleMax) {
			$erreur .= 'Le fichier est trop gros.<br>';
		}
		if ($widthImg > self::$_maxWidthImgax || $heightImg > self::$_maxHeightImg) {
			$erreur .= 'L\'image est trop grande.<br>';
		}
		if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
			//On formate le nom du fichier ici...
			//$fichier = self::FormaterNomFichier($fichier);
			if (move_uploaded_file($file['tmp_name'], self::$_dossier . $fichier)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
				echo 'Upload effectué avec succès !';
			} else { //Sinon (la fonction renvoie FALSE).
				echo 'Echec de l\'upload !';
			}
		} else {
			echo $erreur;
		}
	}

	private static function FormaterNomFichier($nomFichier) {
		//On remplace les lettres accentutées par les non accentuées dans $nomFichier et on récupère le résultat dans nomFichier
		$nomFichier = strtr($nomFichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

		//On remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre dans $nomFichier par un tiret "-" et qui place le résultat dans $nomFichier.
		$nomFichier = preg_replace('/([^.a-z0-9]+)/i', '-', $nomFichier);
	}

}

class UploadException extends Exception {

	public function __construct($code) {
		$message = $this->codeToMessage($code);
		parent::__construct($message, $code);
	}

	private function codeToMessage($code) {
		switch ($code) {
			case UPLOAD_ERR_INI_SIZE:
				$message = "Le fichier téléchargé excède la taille de upload_max_filesize, configurée dans le php.ini.";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$message = "Le fichier téléchargé excède la taille de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.";
				break;
			case UPLOAD_ERR_PARTIAL:
				$message = "Le fichier n'a été que partiellement téléchargé.";
				break;
			case UPLOAD_ERR_NO_FILE:
				$message = "Aucun fichier n'a été téléchargé.";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$message = "Un dossier temporaire est manquant.";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$message = "Échec de l'écriture du fichier sur le disque.";
				break;
			case UPLOAD_ERR_EXTENSION:
				$message = "Une extension PHP a arrêté l'envoi de fichier.";
				break;

			default:
				$message = "Erreur inconnue.";
				break;
		}
		return $message;
	}

}

/*
  // Use
  if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
  //uploading successfully done
  } else {
  throw new UploadException($_FILES['file']['error']);
  }
 */
?>