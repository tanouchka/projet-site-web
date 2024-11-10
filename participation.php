<?php
// Démarre la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer l'email de l'utilisateur connecté
$email = $_SESSION['email']; // Assurez-vous que l'email est bien défini

// Connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$nom_base_donnée = "sport";

$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

// Vérifiez la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer l'id de l'entraînement soumis
if (isset($_POST['id_entrainement'])) {
    $id_entrainement = mysqli_real_escape_string($conn, $_POST['id_entrainement']);

    // Vérifier si l'utilisateur est déjà inscrit à cet entraînement
    $check_query = "SELECT * FROM participant WHERE email = ? AND id_entrainement = ?";
    $stmt = $conn->prepare($check_query);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("si", $email, $id_entrainement);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Message si l'utilisateur est déjà inscrit
        echo "Vous êtes déjà inscrit à cet entraînement.";
    } else {
        // Inscrire l'utilisateur à l'entraînement
        $insert_query = "INSERT INTO participant (email, id_entrainement) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);

        if (!$stmt) {
            die("Erreur de préparation de la requête d'insertion : " . $conn->error);
        }

        $stmt->bind_param("si", $email, $id_entrainement);

        if ($stmt->execute()) {
            // Redirection après inscription réussie
            header("Location: accueil.php?inscription=success");
            exit();
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->error;
        }
    }
    $stmt->close();
} else {
    echo "Aucune donnée d'inscription reçue.";
}

// Fermeture de la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à un Entraînement</title>
</head>
<body>
<h2>Inscription à un Entraînement</h2>

<form action="inscription.php" method="POST">
    <label for="id_entrainement">ID Entraînement :</label>
    <input type="text" id="id_entrainement" name="id_entrainement" required><br><br>

    <input type="submit" value="S'inscrire">
</form>
</body>
</html>