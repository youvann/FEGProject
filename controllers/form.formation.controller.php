<?php
/**
 * Renvoie le choix de la liste formation précédent et
 * le choix de la liste formation souhaitée
 */

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

if(isset($_POST['liste1']) && isset($_POST['liste2'])) {
    if(($_POST['liste1'] != '') && ($_POST['liste2'] != '')) {
        $reponse = 'ok';
    } 
} else {
    $reponse = 'erreur';
}

echo json_encode(array(
	'reponse' => $reponse,
	'liste1'  => $_POST['liste1'],
	'liste2'  => $_POST['liste2'])
);

?>