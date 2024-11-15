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
?>

<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email']) || strpos($_SESSION['email'], '@groupe-esigelec.org') === false) {
    header("Location: connexion.php");
    exit();
}

// Connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "grp_7_10";
$mot_de_passe = "D3UOxuGXIXUJih";
$nom_base_donnée = "bdd_7_10";
$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

// Vérifiez la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Annuler un entraînement
if (isset($_POST['annuler'])) {
    $id_entrainement = intval($_POST['id_entrainement']);
    
    // Supprimer les participants associés à l'entraînement
    $deleteParticipantsQuery = "DELETE FROM participant WHERE id_entrainement = ?";
    $stmt = $conn->prepare($deleteParticipantsQuery);
    $stmt->bind_param("i", $id_entrainement);
    
    if ($stmt->execute()) {
        // Supprimer l'entraînement de la base de données
        $deleteQuery = "DELETE FROM entrainements WHERE id_entrainement = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id_entrainement);
        
        if ($stmt->execute()) {
            // Envoi d'un message aux utilisateurs inscrits
            envoyerMessageAuxInscrits($id_entrainement);
            echo "Entraînement annulé avec succès.";
        } else {
            echo "Erreur lors de l'annulation de l'entraînement : " . mysqli_error($conn);
        }
    } else {
        echo "Erreur lors de la suppression des participants : " . mysqli_error($conn);
    }
    
    $stmt->close();
}

// Fonction pour envoyer un message aux utilisateurs inscrits
function envoyerMessageAuxInscrits($id_entrainement) {
    global $conn;

    // Récupérer les utilisateurs inscrits
    $query = "SELECT id_user FROM participant WHERE id_entrainement = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_entrainement);
    $stmt->execute();
    $result = $stmt->get_result();

    $emails = [];
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['id_user']; // Assurez-vous que id_user contient l'email
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuler un Entraînement</title>
</head>
<body>
    <h1>Annuler un Entraînement</h1>
    <form action="" method="POST">
        <label for="id_entrainement">ID de l'Entraînement :</label>
        <input type="number" name="id_entrainement" required>
        <input type="submit" name="annuler" value="Annuler l'Entraînement">
    </form>
</body>
</html>
