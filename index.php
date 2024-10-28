<?php
    session_start();
    $titre = "Accueil";
    include 'header.inc.php';
    include 'menu.inc.php';
?>
<link rel="stylesheet" href="acceuil.css">
<div class="container">
    <?php
        if(isset($_SESSION['message'])) {
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
            echo $_SESSION['message'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']);
        }
    ?>
        <h1>Bienvenue à vous</h1>
        <p>On espère que vous n'allez pas vous ennuyer. <b>Lettttt's GO.</b></p>
</div>
<?php
    include 'footer.inc.php';
?><?php
session_start();
$titre = "Accueil";
include 'header.inc.php';
include 'menu.inc.php';
?>
<link rel="stylesheet" href="acceuil.css">
<div class="container">
<?php
    if(isset($_SESSION['message'])) {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
        echo $_SESSION['message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['message']);
    }
?>
    <h1>Bienvenue à vous</h1>
    <p>On espère que vous n'allez pas vous ennuyer. <b>Lettttt's GO.</b></p>
</div>
<?php
include 'footer.inc.php';
?><?php
session_start();
$titre = "Accueil";
include 'header.inc.php';
include 'menu.inc.php';
?>
<link rel="stylesheet" href="acceuil.css">
<div class="container">
<?php
    if(isset($_SESSION['message'])) {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
        echo $_SESSION['message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['message']);
    }
?>
    <h1>Bienvenue à vous</h1>
    <p>On espère que vous n'allez pas vous ennuyer. <b>Lettttt's GO.</b></p>
</div>
<?php
include 'footer.inc.php';
?>

