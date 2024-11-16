<?php

$email = $_POST['email'];

// Valeur du statut administrateur
$nouveauStatut = "admin";

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root"; // L'utilisateur par défaut de MySQL dans XAMPP
$passwords = "root"; // Mot de passe
$database = "run";

// Créer une connexion
$conn = new mysqli($servername, $username, $passwords, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Vérifier si l'utilisateur existe déjà
$checkUserQuery = "SELECT * FROM utilisateur WHERE email='$email'";
$result = $conn->query($checkUserQuery);

if ($result->num_rows > 0) {
    // L'utilisateur existe : mise à jour du statut
    $updateUserQuery = "UPDATE utilisateur SET statut='$nouveauStatut' WHERE email='$email'";

    if ($conn->query($updateUserQuery) === TRUE) {
        echo "Le compte de l'utilisateur avec l'adresse e-mail '$email' a été transformé en compte administrateur.";
    } else {
        echo "Erreur lors de la mise à jour du statut : " . $conn->error;
    }
} else {
    // L'utilisateur n'existe pas
    echo "Erreur : Aucun utilisateur trouvé avec l'adresse e-mail '$email'.";
}

// Fermer la connexion
$conn->close();
?>


