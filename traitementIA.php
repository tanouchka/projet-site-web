<?php

$email = $_POST['email'];

// Valeur du statut administrateur
$nouveauStatut = "admin";

$servername = "localhost";
$username = "root"; 
$passwords = "root"; 
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

// Début du HTML pour le style et la mise en page
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("background.jpg"); /* Remplacez "background.jpg" par le chemin vers votre image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            background-color: skyblue;
        }
        .message-box {
            background-color: rgba(0, 0, 0, 0.6); /* Fond semi-transparent */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        h1, p {
            margin: 0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>';

if ($result->num_rows > 0) {
    // L'utilisateur existe : mise à jour du statut
    $updateUserQuery = "UPDATE utilisateur SET statut='$nouveauStatut' WHERE email='$email'";

    if ($conn->query($updateUserQuery) === TRUE) {
        echo '<div class="message-box">
                <h1>Succès !</h1>
                <p>Le compte de l\'utilisateur avec l\'adresse e-mail <strong>' . htmlspecialchars($email) . '</strong> a été transformé en compte administrateur.</p>
              </div>';
    } else {
        echo '<div class="message-box">
                <h1>Erreur</h1>
                <p>Erreur lors de la mise à jour du statut : ' . htmlspecialchars($conn->error) . '</p>
              </div>';
    }
} else {
    // L'utilisateur n'existe pas
    echo '<div class="message-box">
            <h1>Erreur</h1>
            <p>Aucun utilisateur trouvé avec l\'adresse e-mail <strong>' . htmlspecialchars($email) . '</strong>.</p>
          </div>';
}

// Fin du HTML
echo '</body></html>';

// Fermer la connexion
$conn->close();
