
<?php

$host = "localhost"; 
$login = "root"; 
$passwd = "root"; 
$database = "run"; 

$connexion = mysqli_connect($host, $login, $passwd, $database);

if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>