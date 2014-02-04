<?php


function WriteCsv() {
    


// configuration de la base de données base de données
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'fegtest1';
//nom du fichier à générer 
$fichier='export_bdd_fegtest.csv';

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




WriteCsv();