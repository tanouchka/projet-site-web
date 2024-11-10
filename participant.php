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

// Vérifie si un ID d'entraînement a été passé dans l'URL
if (isset($_GET['id_entrainement'])) {
    $id_entrainement = mysqli_real_escape_string($conn, $_GET['id_entrainement']);

    // Requête pour récupérer les participants pour l'entraînement spécifique
    $query = "SELECT p.id_user, u.nom, u.prenom, e.nom AS entrainement_nom, p.date_inscription
              FROM participant p 
              JOIN utilisateurs u ON p.id_user = u.email 
              JOIN entrainements e ON p.id_entrainement = e.id_entrainement 
              WHERE p.id_entrainement = '$id_entrainement'";

    $result = mysqli_query($conn, $query);

    // Vérifie si des participants ont été trouvés
    $participants = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $participants[] = $row;
        }
    } else {
        echo "Erreur dans la requête : " . mysqli_error($conn);
    }
} else {
    echo "Aucun ID d'entraînement spécifié.";
}

// Fermeture de la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants à l'Entraînement</title>
    <link rel="stylesheet" href="participants.css">
</head>
<body>
<header>
    <h1>Participants à l'Entraînement</h1>
    <nav>
        <a href="deconnexion.php">Déconnexion</a>
        <a href="accueil.php">Retour à l'accueil</a>
    </nav>
</header>

<section>
    <h2>Liste des Participants</h2>
    <table>
        <thead>
            <tr>
                <th>Email de l'utilisateur</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Entraînement</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($participants)): ?>
                <tr>
                    <td colspan="5">Aucun participant inscrit pour cet entraînement.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($participants as $participant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($participant['id_user']); ?></td>
                        <td><?php echo htmlspecialchars($participant['nom']); ?></td>
                        <td><?php echo htmlspecialchars($participant['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($participant['entrainement_nom']); ?></td>
                        <td><?php echo htmlspecialchars($participant['date_inscription']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>
</body>
</html>
