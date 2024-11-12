<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/A2/DevWebS3/ressources/css/stylesTD.css">
    <link rel="icon" type="image/x-icon" href="/A2/DevWebS3/TD/TDCOVOITURAGE/ressources/images/favicon.png">
    <title> HAYE Marc - Test Query PHP </title>
</head>

<body>

<h1>TD3 - Requêtes Basiques </h1>

<?php
require_once 'Voiture.php';

echo "<h1>SELECT * FROM voiture;</h1>";

echo "<br>------------------------------------------------- <br>";

echo "Liste des Trajets :";
echo "<br> ";

echo "<ul>";

foreach (Voiture::getVoitures() as $voiture)
{
    echo "<li>";

    if (!$voiture) echo "Trajet sans informations";
    else echo $voiture->__toString();

    echo "</li>";
}

echo "</ul>";

echo "<br>------------------------------------------------- <br>";

?>

</body>
</html>








