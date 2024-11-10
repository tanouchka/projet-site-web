<?php
// Démarre la session
session_start();

// Détruit toutes les données de la session
session_unset();
session_destroy();

// Redirige vers la page de connexion
header("Location: connexion.php");
exit();
?>