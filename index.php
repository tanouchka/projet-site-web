<?php
//Nous allons démarrer la  session avant tout
session_start();
  if (isset($_POST['Valider'])) {
    // Votre code de traitement du formulaire
    assert($_POST['Valider']); // Si vous avez besoin de cette ligne
} 
//Vérification du formulaire
if(isset($_POST['email']) && isset($_POST['mdp'])){ //On vérifie si des informations sont mise dans les espaces
    //Nous allons mettre l'email et le mot de passe dans des variables
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $erreur="";
    //Nous allons vérifier si les informations entrée sont correctes
    //Connexion à la base de données
    $nom_serveur ="localhost";
    $utilisateur ="root";
    $mot_de_passe ="";
    $nom_base_donnée="formulaire";
    $con = mysqli_connect($nom_serveur , $utilisateur , $mot_de_passe ,  $nom_base_donnée);
    //requête pour séléctionner l'utilisateur qui a pour  email et mot de passe les informations entrée
    $req = mysqli_query($con , "SELECT *  FROM utilisateurs WHERE email='$email' AND  mdp='$mdp' ");
    $num_ligne = mysqli_num_rows($req); //Compter  le nombre de ligne ayant rapport à la requête SQL
    if($num_ligne > 0){ 
        header("Location:bienvenu.php");  //Si le nombre de ligne est > 1, on sera redirigé vers la page bienvenu
        //Nous allons créer une variable de type session qui vas contenir l'email de l'utilisateur
        $_SESSION ['email']=$email;
    }else{
        $erreur = "Veuillez réessayer, id incorrectes";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion pour une page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
        <p class="header-welcome">Bonjour à vous!!!</p> <!-- Texte de bienvenue à gauche -->

        <h1>Online Spot</h1> <!-- Texte au milieu -->
        <nav>
            <a href="Apropos.php">A propos</a>
        </nav>
    </header>
    <section>
        <h1>Connexion</h1>
        <?php 
        if (isset($erreur)){ // Affichage de l'erreur si elle existe
            echo "<p class='Erreur'>$erreur.</p>";
        }
        ?>
        <form action="" method="POST">
            <label>Adresse Mail</label>
            <input type="text" name="email">
            <label>Mot de Passe</label>
            <input type="password" name="mdp">
            <input type="submit" value="Valider">
        </form>
    </section>
</body>
</html> 
