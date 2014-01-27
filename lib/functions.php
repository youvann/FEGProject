<?php

function xml2array($xmlObject, $out = array()) {
    foreach ((array) $xmlObject as $index => $node) {
        $out[$index] = (is_object($node)) ? xml2array($node) : $node;
    }
    return $out;
}


function folderToZip($folder, &$zipFile, $subfolder = null) {
    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
    $folder .= end(str_split($folder)) == "/" ? "" : "/";
    $subfolder .= end(str_split($subfolder)) == "/" ? "" : "/";
    // we start by going through all files in $folder
    $handle = opendir($folder);
    while ($f = readdir($handle)) {
        if ($f != "." && $f != "..") {
            if (is_file($folder . $f)) {
                // if we find a file, store it
                // if we have a subfolder, store it there
                if ($subfolder != null)
                    $zipFile->addFile($folder . $f, $subfolder . $f);
                else
                    $zipFile->addFile($folder . $f);
            } elseif (is_dir($folder . $f)) {
                // if we find a folder, create a folder in the zip
                $zipFile->addEmptyDir($f);
                // and call the function again
                folderToZip($folder . $f, $zipFile, $f);
            }
        }
    }
}

/*
Use it like this:

$z = new ZipArchive();
$z->open("test.zip", ZIPARCHIVE::CREATE);
folderToZip("storeThisFolder", $z);
$z->close();
*/


function folderToZip2 ($path) {
    /*$zip = new ZipArchive;
    //$n = date('h.i.s-j:m:y').'.zip';
    $n = 'test.zip';
    $zip->open($n, ZipArchive::CREATE);
    if (false !== ($dir = opendir($path))) {
        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                $zip->addFile($path.DIRECTORY_SEPARATOR.$file);
            } else {
                die('Can\'t read dir motha');
            }
        }
    }
    $zip->close();
    return $n;*/

    $zip = new ZipArchive;
    $n = 'file2.zip';
    $zip->open($n, ZipArchive::CREATE);
    if (false !== ($dir = opendir($path)))
    {
        while (false !== ($file = readdir($dir)))
        {
            if ($file != '.' && $file != '..')
            {
                $zip->addFile($path.DIRECTORY_SEPARATOR.$file);
            }
        }
    }
    else
    {
        die('Can\'t read dir');
    }
    $zip->close();
    return $n;
}