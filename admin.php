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

// Connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "grp_7_10";
$mot_de_passe = "D3UOxuGXIXUJih";
$nom_base_donnée = "bdd_7_10";

$conn = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

// Vérifiez la connexion
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Requête pour récupérer les participants et leurs entraînements
$query = "SELECT p.email, e.nom AS entrainement_nom, e.date AS entrainement_date 
          FROM participant p 
          JOIN entrainements e ON p.id_entrainement = e.id_entrainement";

$result = mysqli_query($conn, $query);

// Vérifie si des participants ont été trouvés et réorganise les données
$participants = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        if (!isset($participants[$email])) {
            $participants[$email] = [];
        }
        $participants[$email][] = [
            'entrainement_nom' => $row['entrainement_nom'],
            'entrainement_date' => $row['entrainement_date']
        ];
    }
} else {
    echo "Erreur dans la requête : " . mysqli_error($conn);
}

// Fermeture de la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Participants</title>
    <style>
        /* Style pour le corps de la page */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

/* Style de l'en-tête */
header {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #007bff;
    padding: 15px;
    color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-welcome {
    font-size: 20px;
    margin: 0;
}

/* Style pour le lien de déconnexion */
header nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 15px;
    border: 1px solid white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

header nav a:hover {
    background-color: white;
    color: #007bff;
}

/* Espace pour le contenu principal, à cause de l'en-tête fixe */
section {
    margin-top: 80px; /* Ajuste selon la hauteur de l'en-tête */
    padding: 20px;
    text-align: center;
}

/* Style du titre principal */
section h2 {
    font-size: 24px;
    color: #333;
}

/* Style du tableau des participants */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #007bff;
    color: white;
}

/* Style des éléments de la liste */
ul {
    list-style-type: disc;
    padding-left: 20px;
    text-align: left;
}

ul li {
    margin-bottom: 20px;
}

/* Style du titre d'email */
h3 {
    font-size: 18px;
    color: #007bff;
    margin-bottom: 10px;
}
    </style>
    <!-- <link rel="stylesheet" href="admin.css"> -->
</head>
<body>
<header>
    <h1>Administration des Participants</h1>
    <nav>
        <a href="deconnexion.php">Déconnexion</a>
        <a href="accueil.php">Retour à l'accueil</a>
    </nav>
</header>

<section>
    <h2>Liste des Participants</h2>
    <?php if (empty($participants)): ?>
        <p>Aucun participant inscrit.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($participants as $email => $entrainements): ?>
                <li>
                    <h3><?php echo htmlspecialchars($email); ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Entraînement</th>
                                <th>Date de l'entraînement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entrainements as $entrainement): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($entrainement['entrainement_nom']); ?></td>
                                    <td><?php echo htmlspecialchars($entrainement['entrainement_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
</body>
</html>