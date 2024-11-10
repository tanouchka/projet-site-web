<?php
// Démarre la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Affiche un message pour le débogage (à retirer en production)
    echo "Redirection vers la page de connexion...";

    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}
?>

<?php
// Récupère l'email de l'utilisateur pour le message d'accueil
$email = $_SESSION['email'];

// Connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$nom_base_donnée = "sport";

// Établir la connexion
$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

// Vérifiez la connexion
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Requête pour récupérer les entraînements disponibles
$query = "SELECT id_entrainement, nom, description, duree, date FROM entrainements";
$result = mysqli_query($conn, $query);

// Vérifie si des entraînements ont été trouvés
$entrainements = [];
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Récupère les données dans un tableau
        while ($row = mysqli_fetch_assoc($result)) {
            $entrainements[] = $row;
        }
    } else {
        echo "Aucun entraînement disponible.";
    }
} else {
    echo "Erreur dans la requête : " . mysqli_error($conn);
}

// Requête pour récupérer les entraînements auxquels l'utilisateur est inscrit
$query_inscrits = "SELECT e.id_entrainement, e.nom, e.date 
                   FROM entrainements e 
                   INNER JOIN participant p ON e.id_entrainement = p.id_entrainement 
                   WHERE p.email = '$email'";
$result_inscrits = mysqli_query($conn, $query_inscrits);

$entrainements_inscrits = [];
if ($result_inscrits && mysqli_num_rows($result_inscrits) > 0) {
    while ($row = mysqli_fetch_assoc($result_inscrits)) {
        $entrainements_inscrits[] = $row;
    }
}

// Fermeture de la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
<header>
    <p class="header-welcome">Bienvenue sur Online Spot!</p>
    <nav>
        <a href="deconnexion.php">Déconnexion</a>
    </nav>
</header>

<section>
    <h1>Bienvenue, <?php echo htmlspecialchars($email); ?>!</h1>
    <p>Vous êtes maintenant connecté à votre compte. Profitez de nos services!</p>

    <h2>Entraînements Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Durée (Heures)</th>
                <th>Date</th>
                <th>Inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($entrainements)): ?>
                <tr>
                    <td colspan="6">Aucun entraînement disponible.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($entrainements as $entrainement): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($entrainement['id_entrainement']); ?></td>
                        <td><?php echo htmlspecialchars($entrainement['nom']); ?></td>
                        <td><?php echo htmlspecialchars($entrainement['description']); ?></td>
                        <td><?php echo htmlspecialchars($entrainement['duree']); ?></td>
                        <td><?php echo htmlspecialchars($entrainement['date']); ?></td>
                        <td>
                            <form action="participation.php" method="post">
                                <input type="hidden" name="id_entrainement" value="<?php echo htmlspecialchars($entrainement['id_entrainement']); ?>">
                                <button type="submit">S'inscrire</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<!-- Conteneur des entraînements inscrits -->
<aside style="position: fixed; right: 0; top: 80px; width: 300px; background-color: #f9f9f9; padding: 20px; border-left: 1px solid #ddd;">
    <h2>Vos Entraînements Inscrits</h2>
    <ul>
        <?php if (empty($entrainements_inscrits)): ?>
            <li>Aucun entraînement inscrit.</li>
        <?php else: ?>
            <?php foreach ($entrainements_inscrits as $inscrit): ?>
                <li><?php echo htmlspecialchars($inscrit['nom']) . " - " . htmlspecialchars($inscrit['date']); ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</aside>

</body>
</html>
