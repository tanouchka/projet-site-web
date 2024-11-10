<?php
// Démarre la session
session_start();

// Si le formulaire est soumis
if (isset($_POST['Inscrire'])) {
    // Récupère les données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
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

    // Vérifie si l'email est déjà utilisé
    $checkUserQuery = "SELECT * FROM utilisateurs WHERE email='$email'";
    $checkUserResult = mysqli_query($con, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) > 0) {
        $erreur = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // Insère l'utilisateur dans la base de données
        $insertUserQuery = "INSERT INTO utilisateurs (email, mdp, nom, prenom) VALUES ('$email', '$mdp', '$nom', '$prenom')";
        if (mysqli_query($con, $insertUserQuery)) {
            // Redirige vers la page de connexion
            header("Location: connexion.php");
            exit();
        } else {
            $erreur = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
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
    <title>Inscription</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
    <p class="header-welcome">Bonjour! Inscrivez-vous pour rejoindre Online Spot!</p>
    <nav>
        <a href="A_propos.php">A propos</a>
    </nav>
</header>

<section>
    <h1>Inscription</h1>
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
        
        <label>Nom</label>
        <input type="text" name="nom" required>
        
        <label>Prénom</label>
        <input type="text" name="prenom" required>
        <input type="submit" name="Inscrire" value="S'inscrire">
    </form>
</section>
</body>
</html>

