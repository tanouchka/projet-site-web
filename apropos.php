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
    background-color: #f4f4f4;
}

header {
    background-color: #007bff;
    padding: 10px;
    text-align: center;
}

header nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

header nav ul li {
    display: inline;
    margin-right: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

main {
    padding: 20px;
}

.activities-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.activity {
    background-color: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.activity h3 {
    margin-top: 0;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}
    </style>
</head>
<?php
// Démarre la session pour vérifier si l'utilisateur est connecté
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";  // Change ces valeurs selon tes paramètres
$password = "root";
$database = "run";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer les activités depuis la base de données
$sql = "SELECT * FROM run";
$result = $conn->query($sql);


// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Activités Running</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assure-toi que le chemin vers le CSS est correct -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Si tu utilises Bootstrap -->
</head>
<body>


    <!-- Contenu principal de la page -->
    <main>
        <section>
            <h1>À propos de notre site de Running</h1>
            <p>Bienvenue sur notre plateforme dédiée au running ! Que vous soyez un coureur débutant ou expérimenté, nous avons des activités adaptées à tous les niveaux.</p>
            <p>Notre mission est de créer une communauté dynamique autour du sport, où chacun peut progresser à son rythme et partager des moments d'effort et de convivialité.</p>
            
            <h2>Nos activités Running</h2>
            <div class="activities-list">
                <?php if (!empty($activites)): ?>
                    <?php foreach ($activites as $activite): ?>
                        <div class="activity">
                            <h3><?php echo htmlspecialchars($activite['titre']); ?></h3>
                            <p><?php echo nl2br(htmlspecialchars($activite['description'])); ?></p>
                            <img src="images/<?php echo htmlspecialchars($activite['image_url']); ?>" alt="<?php echo htmlspecialchars($activite['titre']); ?>" class="activity-image">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune activité n'est disponible pour le moment. Veuillez revenir plus tard.</p>
                <?php endif; ?>
            </div>

            <h2>Pourquoi nous rejoindre ?</h2>
            <p>Notre site est conçu pour vous offrir une expérience de running optimale, avec :</p>
            <ul>
                <li>Une communauté active et motivée</li>
                <li>Des événements réguliers adaptés à tous les niveaux</li>
                <li>Des conseils d'experts pour progresser rapidement</li>
                <li>Des fonctionnalités pour suivre vos progrès et partager vos résultats</li>
            </ul>
            <p>Que vous soyez à la recherche de défis, d'un accompagnement ou simplement d'une activité sportive agréable, nous avons tout ce qu'il vous faut.</p>

            <h2>Rejoignez-nous</h2>
            <p>Inscrivez-vous dès maintenant pour découvrir nos activités et commencer à courir avec nous !</p>
            <a href="inscription.html" class="btn btn-primary">S'inscrire</a>

            
            <h3>vous faites déjà parti dde l'équipe?</h3>
            <p>continuer à courir avec nous !</p>
            <a href="connexion.php" class="btn btn-primary">connexions</a>
        </section>
    </main>

    

</body>
</html>