
<?php

// Informations de connexion à la base de données
$host = "localhost"; // Adresse du serveur MySQL
$login = "grp_7_10"; // Nom d'utilisateur MySQL
$passwd = "D3UOxuGXIXUJih"; // Mot de passe MySQL
$database = "bdd_7_10"; // Nom de la base de données

// Connexion à la base de données
$connexion = mysqli_connect($host, $login, $passwd, $database);

// Vérifier la connexion
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>