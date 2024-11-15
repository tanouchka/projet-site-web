<?php
session_start(); // Démarrage de la session pour stocker des messages entre les pages

/*// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'admin') {
    header('Location: index.php'); // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
    exit();
}*/

// Inclure le fichier de configuration de la base de données
require_once("connexion-bdd.php");

/*// Fonction pour échapper les chaînes et prévenir les attaques par injection SQL
function escapeString($value) {
    global $mysqli;
    return $mysqli->real_escape_string($value);
}*/

// Ajouter un entrainement
if (isset($_POST['ajouter'])) {
    // Récupérer les données du formulaire
    $nom = escapeString($_POST['nom']);
    $description = escapeString($_POST['descriptions']);
    $categorie = escapeString($_POST['categorie']);
    $date = escapeString($_POST['date_et_heure']);
    $nombre = escapeString($_POST['nombre_max_de_participants']);
    $photo = escapeString($_POST['photo']);


    // Préparer la requête SQL d'insertion
    $insertQuery = "INSERT INTO jeu (nom, descriptions, categorie, date_et_heure, nombre_max_de_participants, photo) VALUES ('$nom', '$description', '$categorie', '$date', '$nombre', '$photo')";

    // Exécuter la requête d'insertion
    if ($mysqli->query($insertQuery)) {
        $_SESSION['message'] = "L'entrainement a été ajouté avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de l'entrainement : " . $mysqli->error;
    }

    // Rediriger vers la page admin.php
    header('Location:admin.php');
    exit();
}

// Supprimer un entrainement
if (isset($_GET['supprimer'])) {
    // Récupérer l'ID du jeu à supprimer
    $id_jeu = escapeString($_GET['supprimer']);

    // Préparer la requête SQL de suppression
    $deleteQuery = "DELETE FROM jeu WHERE id_jeu = '$id_jeu'";

    // Exécuter la requête de suppression
    if ($mysqli->query($deleteQuery)) {
        $_SESSION['message'] = "Le jeu a été supprimé avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression du jeu : " . $mysqli->error;
    }

    // Rediriger vers la page admin.php
    header('Location: admin.php');
    exit();
}

// Modifier un jeu
if (isset($_POST['modifier'])) {
    // Récupérer les données du formulaire
    $id_jeu = escapeString($_POST['id_jeu']);
    $nom = escapeString($_POST['nom']);
    $description = escapeString($_POST['descriptions']);
    $categorie = escapeString($_POST['categorie']);
    $regle_du_jeu = escapeString($_POST['regle_du_jeu']);
    $photo = escapeString($_POST['photo']);

    // Préparer la requête SQL de modification
    $updateQuery = "UPDATE jeu SET nom = '$nom', descriptions = '$description', categorie = '$categorie', regle_du_jeu = '$regle_du_jeu', photo = '$photo' WHERE id_jeu = '$id_jeu'";

    // Exécuter la requête de modification
    if ($mysqli->query($updateQuery)) {
        $_SESSION['message'] = "Le jeu a été modifié avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification du jeu : " . $mysqli->error;
    }

    // Rediriger vers la page admin.php
    header('Location: admin.php');
    exit();
}

include('connexion-bdd.php'); 

$mysqli = new mysqli($host, $login, $passwd, $dbname);
// Récupérer la liste des entrainements depuis la base de données
$selectQuery = "SELECT id_run, nom, descriptions, categorie, date_et_heure, nombre_max_de_participants,, photo FROM entrainement";
$resultat = $mysqli->query($selectQuery);


// Vérifier si la requête a réussi
if ($resultat) {
    // Boucler à travers les résultats
    while ($row = $result->fetch_assoc()) {
        // Faire quelque chose avec les données de chaque ligne
        echo $row['nom']; 
        
}

// Libérer le résultat de la mémoire
$result->free();
} else {
// Afficher une erreur si la requête a échoué
echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
}


// Récupérer le message stocké dans la session
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // Effacer le message de la session pour éviter de l'afficher à nouveau

// Fermer la connexion à la base de données
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
    <!-- Inclure vos styles CSS ici -->
</head>
<body>

    <h1>Page d'administration</h1>

    <!-- Afficher le message stocké dans la session -->
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Formulaire d'ajout de jeu -->
    <h2>Ajouter un entrainement</h2>
    <form method="post" action="liste_entrainement.php">
        <!-- Ajoutez ici les champs du formulaire pour ajouter un entrainement -->
        <input type="submit" name="ajouter" value="Ajouter">
    </form>

    <!-- suppression des jeux existants -->
    <h2>supprimer un jeu</h2>
    <ul>
        
           
        <form method="get" action="suprimejeu.php">
            <input type="hidden" name="supprimer" value="<?php echo $row['id_jeu']; ?>">
            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce jeu ?')">Supprimer</button>
        </form>
    
        
    </ul>

    <!-- Formulaire de modification de jeu -->
    <?php if (isset($_GET['modifier'])) : ?>
    <?php endif; ?>

        
    <h3>Modifier un jeu</h3>
    <form method="post" action="liste_jeu.php">
            <!-- Ajoutez ici les champs du formulaire pour modifier un jeu -->
            <input type="submit" name="modifier" value="Modifier">
    </form>

    <!-- Inclure vos scripts JavaScript ici si nécessaire -->

</body>
</html>