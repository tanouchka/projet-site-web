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
    $statut = "utilisateur"; // Définissez un statut par défaut ici
    $erreur = "";

    // Connexion à la base de données
    $nom_serveur = "localhost";
    $utilisateur = "grp_7_10";
    $mot_de_passe = "D3UOxuGXIXUJih";
    $nom_base_donnée = "bdd_7_10";
    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnée);

    if (!$con) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Vérifie si l'email est déjà utilisé
    $checkUserQuery = "SELECT * FROM utilisateur WHERE email = ?";
    $stmt = mysqli_prepare($con, $checkUserQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $checkUserResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkUserResult) > 0) {
        $erreur = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // Hash du mot de passe
        $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);

        // Insère l'utilisateur dans la base de données avec le statut
        $insertUserQuery = "INSERT INTO utilisateur (email, password, nom, prenom, statut) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertUserQuery);
        mysqli_stmt_bind_param($stmt, "sssss", $email, $hashed_mdp, $nom, $prenom, $statut);

        if (mysqli_stmt_execute($stmt)) {
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
    if (isset($erreur) && $erreur !== "") { // Affiche l'erreur si elle existe
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
        
        <!-- Si vous souhaitez permettre la sélection du statut, ajoutez un champ ici -->
        <label>Statut</label>
        <select name="statut" required>
            <option value="utilisateur">Utilisateur</option>
            <option value="admin">Admin</option>
        </select>
        
        <input type="submit" name="Inscrire" value="S'inscrire">
    </form>
</section>
</body>
</html>
