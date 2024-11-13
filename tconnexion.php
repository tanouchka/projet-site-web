<?php

session_start(); 
// Fonction de connexion à la base de données
function connectDB() {
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    return $mysqli;
}

// Fonction de redirection avec message
function redirectTo($location, $message) {
    $_SESSION['message'] = $message;
    header("Location: $location");
    exit();
}

$email = $_POST['email']; 
$password = $_POST['password']; 

$mysqli = connectDB(); // Connexion à la base de données

// Préparation de la requête SQL avec une requête préparée pour éviter les injections SQL
if ($stmt = $mysqli->prepare("SELECT password, statut FROM utilisateur WHERE email=? ")) {
    $stmt->bind_param("s", $email); // Liaison des paramètres
    $stmt->execute(); // Exécution de la requête
    $result = $stmt->get_result(); // Récupération des résultats

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Récupération de la première ligne de résultat

        // Vérification du mot de passe avec password_verify
        if (password_verify($password, $row["password"])) {
            // Redirection en fonction du statut de l'utilisateur
            if ($row["statut"] == "admin") {
                header('Location:admin.php');
            } elseif ($row["statut"] == "membre") {
                header('Location:sessionmembre.php');
            } else {
                
                redirectTo('accueil1.php', 'Authentification réussie pour un rôle inconnu.');
            }
        } else {
            echo '<script>alert("Ceci est un message d\'alerte en PHP!");</script>';
            redirectTo('accueil1.php', 'Mot de passe incorrect.');
        }
    } else {
        redirectTo('index.php', 'Identifiant inexistant.');
    }
} else {
    // En cas d'erreur de préparation de la requête
    redirectTo('sessionmembre.php', 'Erreur lors de l\'authentification.');
}
?>