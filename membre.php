<?php
// Vérifier si l'utilisateur est connecté
session_start();
/*if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}*/

$servername = "localhost";
$username = "grp_7_10"; 
$passwords = "D3UOxuGXIXUJih"; 
$database = "bdd_7_10"

$mysqli = new mysqli($servername, $username, $passwords, $database);
//$conn = new mysqli($servername, $username, $passwords, $database);
// Récupérer la liste complète des jeux depuis la base de données
$query = "SELECT * FROM bdd_7_10";
$resultat = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil utilisateur</title>
    <!-- Ajoutez des liens vers vos fichiers CSS et autres ressources ici -->
    <style>
         body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-image: url('background other 2.0.png');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         height: 100vh;
         overflow: hidden;

        }
        header {
         text-align: center;
         padding: 10px;
         background-color: #f2f2f2;
        }
        main {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100%;
         color: white;
        }
        .button-container {
         width: 60vw;
         max-width: 600px;
         height: 40vh;
         display: flex;
         justify-content: space-between;
         align-items: flex-start;
         font-size: 4vw;
        }

        button {    
         font-size: 2vw; 
         font-weight: lighter;
         color: white;
         padding: 2vh 5vw;
         background: #000000;
         outline: none;
         cursor: pointer;
         border: none;
         border-radius: 2vw; 
         box-shadow: 0 1vh #000000;
         padding: 10px;
        }

        @media (max-width: 600px) {
         .button-container {
            font-size: 8vw;
         }
        }

        label{
            color:white;
        }
        h1{
            color:white;
        }
        p{
            color:white;
        }
        form {
            display: inline-block;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input {
            padding: 8px;
            margin-bottom: 10px;
        }
        
        #result {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
   
    <h1>bon retour!</h1>
    <p>Que souhaitez-vous faire?</p>

    <!-- Liens vers les pages spécifiques pour les membres -->
    <ul>

        <li><a href="choix.php">acceder à la liste des entrainements</a></li>/*pouvoir s'inscrire se desinscrire*/
        <li><a href="historique.php">historique</a></li>
    
    </ul>


   
<body>