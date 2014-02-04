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






function WriteCsv() 
{
    // configuration de la base de données base de données
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'fegtest1';
    

    //format du CSV
    $csv_terminated = "\n";
    $csv_separator = ";";
    $csv_enclosed = '"';
    $csv_escaped = "\\";

    // requête MySQL
    /*$sql_query = "select NOM, PRENOM, MAIL, FIXE, PORTABLE, YEAR(DATE_NAISSANCE), ANNEE_BAC
              from dossier";*/

    $sql_query = "select *
              from ville";

    // connexion à la base de données
    $link = mysql_connect($host, $user, $pass) or die("Je ne peux me connecter." . mysql_error());
    mysql_select_db($db) or die("Je ne peux me connecter.");

    // exécute la commande
    $result = mysql_query($sql_query);
    $fields_cnt = mysql_num_fields($result); //nombre de champs dans le  résultat

    $schema_insert = '';

    for ($i = 0; $i < $fields_cnt; $i++)
    {
      $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
      stripslashes(mysql_field_name($result, $i))) . $csv_enclosed;
      $schema_insert .= $l;
      $schema_insert .= $csv_separator;
    } // fin for

    // &&&  $out  c'est le contenu du fichier csv
    $out = trim(substr($schema_insert, 0, -1));
    $out .= $csv_terminated;

    // Format des données
    while ($row = mysql_fetch_array($result))
    {
      $schema_insert = '';
      for ($j = 0; $j < $fields_cnt; $j++)
      {
           if ($row[$j] == '0' || $row[$j] != '')
            {

              if ($csv_enclosed == '')
              {
                   $schema_insert .= $row[$j];
              } else
                {
                    $schema_insert .= $csv_enclosed .
                    str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
             }
            } else
            {
               $schema_insert .= '';
            }

         if ($j < $fields_cnt - 1)
          {
             $schema_insert .= $csv_separator;
          }
     }

     $out .= $schema_insert;
     $out .= $csv_terminated;
    }
    
    
    $mentionFormation="miage";
    // &&&  Enregistre le contenu dans un fichier csv
    $file = fopen("C:/wamp/www/FEGProject/csv/$mentionFormation.csv", "w+"); 
    fwrite($file, $out); 
    fclose($file);

}