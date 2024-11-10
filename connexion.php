<?php
// Démarre la session
session_start();

// Vérifie si le formulaire est soumis
if (isset($_POST['Connexion'])) {
    // Récupère les données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $erreur = "";

    // Connexion à la base de données
    $nom_serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "root";
    $nom_base_donnée = "sport";
    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

    if (!$con) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Requête pour vérifier si l'utilisateur existe
    $loginQuery = "SELECT * FROM utilisateurs WHERE email='$email' AND mdp='$mdp'";
    $loginResult = mysqli_query($con, $loginQuery);

    if (mysqli_num_rows($loginResult) > 0) {
        // L'utilisateur est authentifié, on crée la session
        $_SESSION['email'] = $email;

        // Vérifie le rôle en fonction de l'email
        if (strpos($email, '@groupe-esigelec.org') !== false) {
            // Redirige vers la page admin pour les administrateurs
            header("Location: admin.php");
        } elseif (strpos($email, '@gmail.com') !== false) {
            // Redirige vers la page d'accueil pour les membres
            header("Location: accueil.php");
        } else {
            // Redirection par défaut en cas de domaine inconnu (peut être ajustée selon votre logique)
            header("Location: accueil.php");
        }
        exit();
    } else {
        // Erreur de connexion
        $erreur = "Identifiants incorrects. Veuillez réessayer.";
    }

    // Ferme la connexion à la base de données
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="acceuil.css">
</head>
<body>

<section>
    <h1>Connexion</h1>
    <?php 
    if (isset($erreur)) { // Affiche l'erreur si elle existe
        echo "<p class='Erreur'>$erreur</p>";
    }
    ?>
    <form action="" method="POST">
        <label>Adresse Mail</label>
        <input type="email" name="email" required>
        <label>Mot de Passe</label>
        <input type="password" name="mdp" required>
        <input type="submit" name="Connexion" value="Se connecter">
    </form>
</section>
</body>
</html>