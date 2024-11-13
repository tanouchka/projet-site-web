
<?php

// Informations de connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "grp_7_10"; // Nom d'utilisateur MySQL
$mot_de_passe = "D3UOxuGXIXUJih"; // Mot de passe MySQL
$nom_base_de_donnees = "bdd_7_10"; // Nom de la base de données

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>