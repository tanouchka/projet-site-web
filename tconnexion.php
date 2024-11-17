<?php

session_start(); 

// Fonction de connexion à la base de données
function connectDB() {
    require_once("connexion-bdd.php");
    $mysqli = new mysqli($host, $login, $passwd, $database);
    if ($mysqli->connect_error) {
        die('Erreur de connexion à la base de données : ' . $mysqli->connect_error);
    }
    return $mysqli;
}

// Fonction de redirection avec message
function redirectTo($location, $message) {
    $_SESSION['message'] = $message; // Enregistrer le message dans la session
    header("Location: $location");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification que l'email et le mot de passe sont bien envoyés
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            die('L\'email ne peut pas être vide.');
        }

        $mysqli = connectDB(); // Connexion à la base de données

        // Préparation de la requête SQL avec une requête préparée pour éviter les injections SQL
        if ($stmt = $mysqli->prepare("SELECT password, statut FROM utilisateur WHERE email=?")) {
            $stmt->bind_param("s", $email); // Liaison des paramètres
            $stmt->execute(); // Exécution de la requête
            $result = $stmt->get_result(); // Récupération des résultats

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Récupération de la première ligne de résultat

                // Vérification du mot de passe avec password_verify
                if (password_verify($password, $row["password"])) {
                    // Authentification réussie, redirection selon le statut
                    if ($row["statut"] == "admin") {
                        header('Location:admin.php');
                    } elseif ($row["statut"] == "membre") {
                        header('Location:membre.php');
                    } else {
                        redirectTo('index.php', 'Statut inconnu. Accès refusé.');
                    }
                    exit();
                } else {
                    // Si le mot de passe est incorrect
                    redirectTo('index.php', 'Mot de passe incorrect.');
                }
            } else {
                // Si aucun utilisateur n'a été trouvé avec cet email
                redirectTo('index.php', 'Identifiant inexistant.');
            }
        } else {
            // En cas d'erreur lors de la préparation de la requête
            die('Erreur lors de la préparation de la requête : ' . $mysqli->error);
        }
    } else {
        // Si les champs email ou mot de passe sont vides
        redirectTo('index.php', 'Veuillez entrer un email et un mot de passe.');
    }
} else {
    // Si la requête n'est pas de type POST (par exemple si l'utilisateur accède à la page directement)
    redirectTo('index.php', 'Méthode de requête invalide.');
}

?>
