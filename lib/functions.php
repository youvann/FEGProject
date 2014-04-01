<?php
/**
 * Fonctions utilisées pour le projet
 * @Project: FEG Project
 * @File   : /lib/functions.php
 * @Purpose: Regroupe plusieurs fonctions utiles pour le projet
 * @Author : Lionel Guissani & Kévin Meas
 */

/**
 * Compresse un répertoire
 *
 * @param string $source      Chemin du dossier à compresser
 * @param string $destination Chemin du dossier compressé
 *
 * @return bool Indique si l'opération s'est bien passée ou pas
 */
function Zip ($source, $destination) {
    if (!extension_loaded ('zip') || !file_exists ($source)) {
        return false;
    }
    $zip = new ZipArchive();
    if (!$zip->open ($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }
    $source = str_replace ('\\', '/', realpath ($source));
    if (is_dir ($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace ('\\', '/', $file);

            // Ignore "." and ".." folders
            if (in_array (substr ($file, strrpos ($file, '/') + 1), array ('.', '..')))
                continue;

            $file = realpath ($file);

            if (is_dir ($file) === true) {
                $zip->addEmptyDir (str_replace ($source . '/', '', $file . '/'));
            } else if (is_file ($file) === true) {
                $zip->addFromString (str_replace ($source . '/', '', $file), file_get_contents ($file));
            }
        }
    } else if (is_file ($source) === true) {
        $zip->addFromString (basename ($source), file_get_contents ($source));
    }

    $zip->close ();
    return $destination;
}

/**
 * Créé un répertoire s'il n'existe pas
 *
 * @param string $dir Nom du répertoire
 */
function myMkdirBase ($dir) {
    if (!file_exists ($dir)) {
        mkdir ($dir, 0777);
    }
    return true;
}

/**
 * Créé un répertoire s'il n'existe pas
 * Les répertoires Candidatures et Pre-inscriptions sont créés dans le premier répertoire
 *
 * @param string $dir Nom du répertoire
 */
function myMkdirDossier ($dir) {
    if (!file_exists ("dossiers/" . $dir)) {
        mkdir ("dossiers/" . $dir, 0777);
        mkdir ("dossiers/" . $dir . "/Candidatures", 0777);
        mkdir ("dossiers/" . $dir . "/Pre-inscriptions", 0777);
    }
}

/**
 * Copie de manière récursive un répertoire
 *
 * @param string $src Indique le chemin source du répertoire à copier
 * @param string $dst Indique l'endroit où le répertoire est copié
 */
function copyDir ($src, $dst) {
    $dir = opendir ($src);
    @mkdir ($dst);
    while (false !== ($file = readdir ($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir ($src . '/' . $file)) {
                copyDir ($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy ($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir ($dir);
}

/**
 * Supprime un répertoire dont le chemin est passé en paramètre
 *
 * @param string $path
 *
 * @return bool
 */
function removeDir ($path) {
    if (is_dir ($path) === true) {
        $files = array_diff (scandir ($path), array ('.', '..'));
        foreach ($files as $file) {
            removeDir (realpath ($path) . '/' . $file);
        }
        return rmdir ($path);
    } else if (is_file ($path) === true) {
        return unlink ($path);
    }
    return false;
}

/**
 * Supprime uniquement le contenu d'un répertoire dont le chemin est passé en paramètre
 *
 * @param string $path
 *
 * @return bool
 */
function removeDirContent ($path) {
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

/**
 * Liste tous les fichiers d'un répertoire et supprime uniquement le contenu des répertoires Candidatures,
 * Pre-inscriptions et Dossier-Type
 *
 * @param string $path
 */
function listAndRemoveDir ($path) {
    $pathsDelete = array ();
    $othersPath  = array ();
    $path        = realpath ($path);
    $objects     = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($objects as $name => $object) {
        $dirName = explode ("/", $object->getPathname ());
        $dirName = $dirName[sizeof ($dirName) - 2];
        if ($dirName == "Candidatures" || $dirName == "Pre-inscriptions" || $dirName == "Dossier-type") {
            if ($object->getFilename () != ".." && $object->getFilename () != ".") {
                $pathsDelete[] = $object->getPathname ();
            }
        }
        if ($object->getFilename () != ".." && $object->getFilename () != ".") {
            $othersPath[] = $object->getPathname ();
        }
    }

    foreach ($pathsDelete as $pathDelete) {
        removeDir ($pathDelete);
    }

    $name = basename ($othersPath[0]);
    if ($name !== "." && $name !== ".." && $name !== ".DS_Store") {
        if (is_file ($othersPath[0])) {
            $dirPath = dirname ($othersPath[0]);
            removeDir ($dirPath);
        }
    }
}

/**
 * Vérifie si les sous-répertoires sont vides ou non
 *
 * @param string $path
 *
 * @return bool
 */
function IsEmptySubFolders ($path) {
    $empty = true;
    foreach (glob ($path . DIRECTORY_SEPARATOR . "*") as $file) {
        $empty &= is_dir ($file) && IsEmptySubFolders ($file);
    }
    return $empty;
}

/**
 * Vérifie si un répertoire un vide ou non
 *
 * @param string $dir
 *
 * @return bool|null
 */
function is_dir_empty ($dir) {
    if (!is_readable ($dir))
        return null;
    $handle = opendir ($dir);
    while (false !== ($entry = readdir ($handle))) {
        if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
            return false;
        }
    }
    return true;
}

/**
 * Récupère le nom du fichier du chemin passé
 *
 * @param string $path
 *
 * @return string
 */
function getFileName ($path) {
    $dir = opendir ($path);
    while ($file = readdir ($dir)) {
        if ($file != '.' && $file != '..' && $file != '.DS_Store' && !is_dir ($path . $file)) {
            closedir ($dir);
            return $file;
        }
    }
}

/**
 * Permet l'upload des documents multiples
 *
 * @param $output_dir
 */
function upload ($output_dir) {
    if (isset($_FILES["myfile"])) {
        $ret = array ();

        $error = $_FILES["myfile"]["error"];
        //single file
        if (!is_array ($_FILES["myfile"]["name"])) {
            $fileName = $_FILES["myfile"]["name"];
            move_uploaded_file ($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
            $ret[] = $fileName;
        } else { //Multiple files, file[]
            $fileCount = count ($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES["myfile"]["name"][$i];
                move_uploaded_file ($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
                $ret[] = $fileName;
            }
        }
        echo json_encode ($ret);
    }
}

/**
 * Permet l'upload de fichiers dans plusieurs endroits à la fin (whishes)
 *
 * @param string $path1
 * @param string $path2
 * @param string $wishes Endroits où les pièces vont être envoyées
 */
function uploadMultiLocations ($path1, $path2, $wishes) {
    if (isset($_FILES["myfile"])) {
        $ret = array ();

        $error = $_FILES["myfile"]["error"];
        //You need to handle  both cases
        //If Any browser does not support serializing of multiple files using FormData()
        //single file
        if (!is_array ($_FILES["myfile"]["name"])) {
            $fileName = $_FILES["myfile"]["name"];
            foreach ($wishes as $wish) {
                copy ($_FILES["myfile"]["tmp_name"], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
            }
            //move_uploaded_file ($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
            $ret[] = $fileName;
        } else { //Multiple files, file[]
            $fileCount = count ($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES["myfile"]["name"][$i];
                foreach ($wishes as $wish) {
                    copy ($_FILES["myfile"]["tmp_name"], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
                }
                //move_uploaded_file ($_FILES["myfile"]["tmp_name"][$i], $path1 . '/' . $wish . '/' . $path2 . '/' . $fileName);
                $ret[] = $fileName;
            }
        }
        echo json_encode ($ret);
    }
}

/**
 * Formate un string passé en paramètre
 *
 * @param $string
 *
 * @return string
 */
function formatString ($string) {
    $mot = ltrim ($string);
    $mot = rtrim ($mot);
    $mot = strtolower ($mot);
    $mot = ucfirst ($mot);
    return $mot;
}

/**
 * Enlève tous les accents d'un string passé en paramètre
 *
 * @param $str
 *
 * @return mixed|string
 */
function stripAccents ($str) {
    $trans = array ('À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y');

    //On remplace les lettres accentutées par les non accentuées dans $str et on récupère le résultat dans str
    //$str = strtr($str, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $str = strtr ($str, $trans);

    //On remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre dans $str par un tiret "-" et qui place le résultat dans $str.
    $str = preg_replace ('/([^.a-z0-9]+)/i', '-', $str);

    return $str;
}
