<?php

function checkFumeur(string $field) : string
{   
    $tmp = "";
    if ($field == "") {
        $tmp = "Non fumeur";
    }
    return $tmp;
}

function getDateNaissance(string $date) : string
{
    $dateAnniv = explode("-", $date);
    $dateAjd = explode("-", date("Y-m-d"));
      $age = intval($dateAjd[0]) - intval($dateAnniv[0]);
      if ((intval($dateAjd[1]) < intval($dateAnniv[1]) || ((intval($dateAjd[1])) == intval($dateAnniv[1])) && (intval($dateAjd[2]) < intval($dateAnniv[2])))) {
        $age--;
      }
    return($age . "ans");
}

$response = "";
echo $response;
$elementsRecherche = explode(' ', $_GET["recherche"]); // recupération des mots clés.
$file = fopen('./../../register/data/userList.txt', 'r'); // ouverture du fichier
$data = array();
if ($file) {
    while (($line = fgets($file)) !== false) {
        $userData = explode("§", $line);
        $userData[10] = checkFumeur($userData[10]); // permet d'écrire si l'utilisateur fume ou non
        $userData[3] = getDateNaissance($userData[3]); // permet d'écrire l'age de l'utilisateur 
        array_push($data,array_slice($userData,0,sizeof($userData)-7)); // ajoute l'utilisateur à la liste de recherche
    }
    fclose($file);
} else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
}

foreach($data as $utilisateur) {
    foreach ($elementsRecherche as $keyword) {
        $found = false;
        $i = 0;
        while ($i < sizeof($utilisateur) && !$found && (strpos($response,$utilisateur[0]) === false )) { // permet de vérifier tout les données de l'utilisateur
            if (stristr($utilisateur[$i],$keyword)) { // , tant que rien de cohérent n'a été trouvé et que l'utilisateur ne matche pas déjà avec un keyword
                 $response .= $utilisateur[0]; // ajoute l'utilisateur aux résultats
                $found = true;
            }
            $i++;
        }
    }
}

if ($response == "") {
    $response = "Aucun résultat.";
}

echo $response;