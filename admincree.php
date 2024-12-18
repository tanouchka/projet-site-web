<?php
// Vérifier si l'utilisateur est connecté
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma page transformation d'utilisateur</title>
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
        label{
            color:black;
        }
        h1{
            color:black;
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
        button {
            padding: 10px;
            font-size: 16px;
        }
        #result {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Transformer un utilisateur en administrateur</h1>
    
    <a href="admin.php">Retour à la Page précédente</a>
    <form method="POST" action="traitementIA.php">
        <label for="email">E-mail de l'utilisateur :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button class="btn btn-outline-primary" type="submit">Transformer en Admin</button>
    </form>

</body>
</html>