
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
$host = "localhost";
$login = "root";
$passwd = "root";
$database = "run";

$con = mysqli_connect($host, $login, $passwd, $database);


// Vérification de la connexion
if (!$con) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $categorie = (int)$_POST['categorie'];
    $date = mysqli_real_escape_string($con, $_POST['date_et_heure']);
    $nombre = (int)$_POST['nombre_max_de_participants'];

    $requete = "INSERT INTO entrainements (nom, description, categorie, date_et_heure, nombre_max_de_participants) VALUES ('$nom', '$description', '$categorie', '$date', '$nombre')";

    if (mysqli_query($con, $requete)) {
        echo "Entraînement ajouté avec succès !";
    } else {
        echo "Erreur : " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Entraînement</title>
    <style>
/* Général */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    background-size: cover;
    background-position: center;
    background-color: #007bff;
}

/* En-tête */
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

/* Espace pour le contenu principal (compense l'en-tête fixe) */
section {
    margin-top: 80px;
    padding: 20px;
    text-align: center;
}

/* Style du titre principal */
#page-title {
    text-align: center; /* Centrer le titre */
    font-size: 28px;
    color: #333;
    margin-top: 100px; /* Ajouter un peu d'espace au-dessus */
}

/* Style du texte d'accueil */
section p {
    font-size: 18px;
    color: #666;
}

/* Formulaire */
#entrainement-form {
    width: 60%; /* Ajuster la largeur du formulaire */
    margin: 20px auto; /* Centrer le formulaire */
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

/* Éléments de formulaire */
#entrainement-form label {
    font-size: 1.1rem;
    margin-bottom: 5px;
    display: inline-block;
    color: #333;
}

#entrainement-form input[type="text"],
#entrainement-form input[type="number"],
#entrainement-form input[type="date"],
#entrainement-form textarea,
#entrainement-form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

#entrainement-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    border: none;
    color: white;
    font-size: 1.2rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#entrainement-form input[type="submit"]:hover {
    background-color: #45a049;
}

/* Espacement */
br {
    line-height: 1.5;
}

/* Marges */
#entrainement-form input[type="text"],
#entrainement-form input[type="number"],
#entrainement-form input[type="date"],
#entrainement-form textarea,
#entrainement-form select {
    margin-bottom: 15px;
}

/* Message de succès / erreur */
div.success, div.error {
    text-align: center;
    padding: 10px;
    margin-top: 20px;
    border-radius: 4px;
    font-weight: bold;
}

div.success {
    background-color: #dff0d8;
    color: #3c763d;
}

div.error {
    background-color: #f2dede;
    color: #a94442;
}

    </style>
    <link rel="stylesheet" href="entainement.css">
</head>
<body>
    <h1 id="page-title">Ajouter un nouvel Entraînement</h1>
    <form id="entrainement-form" action="" method="POST">
        <label for="nom" id="label-nom">Nom de l'entraînement :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="description" id="label-description">Description :</label>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="nombre" id="label-duree">nombre max de participants :</label>
        <input type="int" id="nombre" name="nombre_max_de_participants" required><br><br>

        <label for="date" id="label-date">Date et heure :</label>
        <input type="datetime-local" id="date" name="date_et_heure" required><br><br>

        <label for="categorie" id="label-niveau">categorie :</label>
        <select id="categorie" name="categorie" required>
            <option value="Débutant">Débutant</option>
            <option value="Moyen">Moyen</option>
            <option value="Expert">Expert</option>
        </select>

        <input type="submit" id="submit-button" value="Ajouter">
    </form>
</body>
</html>

