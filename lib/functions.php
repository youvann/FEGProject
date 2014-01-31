<?php

function xml2array($xmlObject, $out = array()) {
    foreach ((array)$xmlObject as $index => $node) {
        $out[$index] = (is_object($node)) ? xml2array($node) : $node;
    }
    return $out;
}

function Zip($source, $destination) {
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

function myMkdir($dir) {
    if (!file_exists($dir)) {
        mkdir("./dossiers/" . $dir, 0777);
        mkdir("./dossiers/" . $dir . "/Candidatures", 0777);
        mkdir("./dossiers/" . $dir . "/Preinscriptions", 0777);
    }
}

function myMkdirIne($dir){
    if (!file_exists($dir)){
        mkdir("./dossiers/" . $dir, 0777);
    }
}


function removeDir($dir) {
    if (is_dir($dir)) // si c'est un repertoire
        $dh = opendir($dir); // on l'ouvre
    else {
        echo $dir, ' n\'est pas un repertoire valide'; // sinon on sort! Appel de fonction non valide
        exit;
    }
    while (($file = readdir($dh)) !== false) { //boucle pour trouver le contenu du repertoire
        if ($file !== '.' && $file !== '..' && $file) { // no comment
            $path = $dir . '/' . $file; // construction du chemin du fichier
            if (is_dir($path)) { //si on tombe sur un sous-repertoire
                //echo '<p style="font-weight: bold; border : 1pt solid #000000;">', $path, '</p>';
                //echo '<div style="padding-left: 20px; border: 1pt dashed #000000;">'; // idem...
                removeDir($path); // appel recursif pour lire a l'interieur de ce sous-repertoire
                //echo '</div><br />';
                //echo "effacement du rép",$path,'<br />';
                // ne pas supprimer les répertoires Candidatures et Preinscriptions
                if ($file !== "Candidatures" && $file !== "Preinscriptions") {
                    rmdir($path);
                }
            } else {
                //echo "effacement du fichier ",$path, '<br />';
                unlink($path);
            }
        }
    }
    closedir($dh); // on ferme le repertoire courant
}

function dirIsEmpty($path) {
    $empty = true;
    $dir = opendir($path);
    while ($file = readdir($dir)) {
        if ($file !== '.' && $file !== '..') {
            $empty = false;
            break;
        }
    }
    closedir($dir);
    return $empty;
}
