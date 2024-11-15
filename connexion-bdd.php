
<?php

// Informations de connexion à la base de données
$host = "localhost"; // Adresse du serveur MySQL
$login = "root"; // Nom d'utilisateur MySQL
$passwd = "root"; // Mot de passe MySQL
$database = "run"; // Nom de la base de données

// Connexion à la base de données
$connexion = mysqli_connect($host, $login, $passwd, $database);

// Vérifier la connexion
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>