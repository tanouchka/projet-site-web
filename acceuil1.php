<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-UA-compatible" content="IE=edge">
    <meta name="viexport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $Accueil_ESIGELEC_Running; ?></title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<?php 
        $titre_page = "page d'acceuil";
        include 'header.inc.php';
?>

<body>
    

    <main>
        <h1>Bienvenue sur le site de Running de l'ESIGELEC</h1>
        <p>Rejoignez nos sessions de running et progressez ensemble !</p>
        <div class="buttons">
            <a href="pages/register.php" class="btn">S'inscrire</a>
            <a href="pages/login.php" class="btn">Se connecter</a>
        </div>
    </main>

    
</body>
</html>
