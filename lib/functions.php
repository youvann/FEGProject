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
    $n = 'lib/file2' . date('l jS \of F Y h:i:s A') . '.zip';
    $zip->open($n, ZipArchive::CREATE);
    if (false !== ($dir = opendir($path)))
    {
        while (false !== ($file = readdir($dir)))
        {
            if ($file != '.' && $file != '..')
            {
                //var_dump($path.$file);
                $zip->addFile($path.DIRECTORY_SEPARATOR.$file);
                //var_dump($path.DIRECTORY_SEPARATOR.$file);

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

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    $zip->close();
    return $destination;
}