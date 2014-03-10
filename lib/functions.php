<?php

function xml2array($xmlObject, $out = array())
{
	foreach ((array)$xmlObject as $index => $node) {
		$out[$index] = (is_object($node)) ? xml2array($node) : $node;
	}
	return $out;
}

function Zip($source, $destination)
{
	if (!extension_loaded('zip') || !file_exists($source)) {
		return false;
	}

	$zip = new ZipArchive();
	if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
		return false;
	}

	$source = str_replace('\\', '/', realpath($source));

	if (is_dir($source) === true) {
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

		foreach ($files as $file) {
			$file = str_replace('\\', '/', $file);

			// Ignore "." and ".." folders
			if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
				continue;

			$file = realpath($file);

			if (is_dir($file) === true) {
				$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
			} else if (is_file($file) === true) {
				$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
			}
		}
	} else if (is_file($source) === true) {
		$zip->addFromString(basename($source), file_get_contents($source));
	}

	$zip->close();
	return $destination;
}

function myMkdir($dir)
{
	if (!file_exists("dossiers/" . $dir)) {
		mkdir("dossiers/" . $dir, 0777);
		mkdir("dossiers/" . $dir . "/Candidatures", 0777);
		mkdir("dossiers/" . $dir . "/Pre-inscriptions", 0777);
	}
}

function myMkdirBase($dir)
{
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
}

function myMkdirDossier($dir)
{
	if (!file_exists("dossiers/" . $dir)) {
		mkdir("dossiers/" . $dir, 0777);
		mkdir("dossiers/" . $dir . "/Candidatures", 0777);
		mkdir("dossiers/" . $dir . "/Pre-inscriptions", 0777);
	}
}

function copyDir($src, $dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	while (false !== ($file = readdir($dir))) {
		if (($file != '.') && ($file != '..')) {
			if (is_dir($src . '/' . $file)) {
				copyDir($src . '/' . $file, $dst . '/' . $file);
			} else {
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}

/*function removeDir ($dir) {
    if (is_dir ($dir)) // si c'est un repertoire
        $dh = opendir ($dir); // on l'ouvre
    else {
        echo $dir, ' n\'est pas un repertoire valide'; // sinon on sort! Appel de fonction non valide
        exit;
    }
    while (($file = readdir ($dh)) !== false) { //boucle pour trouver le contenu du repertoire
        if ($file !== '.' && $file !== '..' && $file) { // no comment
            $path = $dir . '/' . $file; // construction du chemin du fichier
            if (is_dir ($path)) { //si on tombe sur un sous-repertoire
                //echo '<p style="font-weight: bold; border : 1pt solid #000000;">', $path, '</p>';
                //echo '<div style="padding-left: 20px; border: 1pt dashed #000000;">'; // idem...
                removeDir ($path); // appel recursif pour lire a l'interieur de ce sous-repertoire
                //echo '</div><br />';
                //echo "effacement du rép",$path,'<br />';
                // ne pas supprimer les répertoires Candidatures et Pre-inscriptions
                if ($file !== "Candidatures" && $file !== "Pre-inscriptions" && $file !== "Dossier-type") {
                    rmdir ($path);
                }
            } else {
                //echo "effacement du fichier ",$path, '<br />';
                unlink ($path);
            }
        }
    }
    closedir ($dh); // on ferme le repertoire courant
}*/

function removeDir($path)
{
	if (is_dir($path) === true) {
		$files = array_diff(scandir($path), array('.', '..'));
		foreach ($files as $file) {
			removeDir(realpath($path) . '/' . $file);
		}
		return rmdir($path);
	} else if (is_file($path) === true) {
		return unlink($path);
	}
	return false;
}

function removeDirContent ($path){
    if (is_dir ($path) === true) {
        $files = array_diff (scandir ($path), array ('.', '..'));
        foreach ($files as $file) {
            removeDir (realpath ($path) . '/' . $file);
        }
        return true;
    } else if (is_file ($path) === true) {
        return unlink ($path);
    }
    return false;
}

function listAndRemoveDir($path)
{
	$pathsDelete = array();
    $othersPath = array();
	$path = realpath($path);
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

	foreach ($objects as $name => $object) {
		/*if ($object->getFilename () === 'work.txt') {
			echo $object->getPathname ();
		}*/
		$dirName = explode("/", $object->getPathname());
		$dirName = $dirName[sizeof($dirName) - 2];
		if ($dirName == "Candidatures" || $dirName == "Pre-inscriptions" || $dirName == "Dossier-type") {
			//removeDir($object->getPathname ());
			if ($object->getFilename() != ".." && $object->getFilename() != ".") {
				$pathsDelete[] = $object->getPathname();
			}
		}
        if ($object->getFilename () != ".." && $object->getFilename () != ".") {
            $othersPath[] = $object->getPathname ();
        }
	}

	foreach ($pathsDelete as $pathDelete) {
		removeDir($pathDelete);
	}

    $name = basename ($othersPath[0]);
    if($name !== "." && $name !== ".." && $name !== ".DS_Store"){
        if (is_file ($othersPath[0])) {
            $dirPath = dirname ($othersPath[0]);
            removeDir($dirPath);
        }
    }
}

function IsEmptySubFolders($path)
{
	$empty = true;
	foreach (glob($path . DIRECTORY_SEPARATOR . "*") as $file) {
		$empty &= is_dir($file) && IsEmptySubFolders($file);
	}
	return $empty;
}

function is_dir_empty($dir)
{
	if (!is_readable($dir))
		return null;
	$handle = opendir($dir);
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
			return false;
		}
	}
	return true;
}

function getFileName($path)
{
	$dir = opendir($path);
	while ($file = readdir($dir)) {
		if ($file != '.' && $file != '..' && $file != '.DS_Store' && !is_dir($path . $file)) {
			closedir($dir);
			return $file;
		}
	}
}

function upload($output_dir)
{
	if (isset($_FILES["myfile"])) {
		$ret = array();

		$error = $_FILES["myfile"]["error"];
		//You need to handle  both cases
		//If Any browser does not support serializing of multiple files using FormData()
		//single file
		if (!is_array($_FILES["myfile"]["name"])) {
			$fileName = $_FILES["myfile"]["name"];
			move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
			$ret[] = $fileName;
		} else { //Multiple files, file[]
			$fileCount = count($_FILES["myfile"]["name"]);
			for ($i = 0; $i < $fileCount; $i++) {
				$fileName = $_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
				$ret[] = $fileName;
			}
		}
		echo json_encode($ret);
	}
}

function uploadMultiLocations($path1, $path2, $wishes)
{
	if (isset($_FILES["myfile"])) {
		$ret = array();

		$error = $_FILES["myfile"]["error"];
		//You need to handle  both cases
		//If Any browser does not support serializing of multiple files using FormData()
		//single file
		if (!is_array($_FILES["myfile"]["name"])) {
			$fileName = $_FILES["myfile"]["name"];
			foreach ($wishes as $wish) {
				copy($_FILES["myfile"]["tmp_name"], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
			}
			//move_uploaded_file ($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
			$ret[] = $fileName;
		} else { //Multiple files, file[]
			$fileCount = count($_FILES["myfile"]["name"]);
			for ($i = 0; $i < $fileCount; $i++) {
				$fileName = $_FILES["myfile"]["name"][$i];
				foreach ($wishes as $wish) {
					copy($_FILES["myfile"]["tmp_name"], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
				}
				//move_uploaded_file ($_FILES["myfile"]["tmp_name"][$i], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
				$ret[] = $fileName;
			}
		}
		echo json_encode($ret);
	}
}

function formatString($string)
{
	$mot = ltrim($string);
	$mot = rtrim($mot);
	$mot = strtolower($mot);
	$mot = ucfirst($mot);
	return $mot;
}

/**
 * @param $str
 * @return mixed|string
 */
function stripAccents($str)
{
	$trans = array('À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
		'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
		'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
		'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
		'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
		'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
		'ð' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
		'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y');

	//On remplace les lettres accentutées par les non accentuées dans $str et on récupère le résultat dans str
	//$str = strtr($str, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	$str = strtr($str, $trans);

	//On remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre dans $str par un tiret "-" et qui place le résultat dans $str.
	$str = preg_replace('/([^.a-z0-9]+)/i', '-', $str);

	return $str;
}
