
<?php

$host = "localhost"; 
$login = "grp_7_10"; 
$passwd = "D3UOxuGXIXUJih"; 
$database = "bdd_7_10"; 

$connexion = mysqli_connect($host, $login, $passwd, $database);

if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>