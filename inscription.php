<?php
session_start();
$titre = "Inscription";
include 'header.inc.php';
include 'menu.inc.php';
?>
<link rel="stylesheet" href="inscription.css">
<div class="container my-5 justify-center">
    <h1 class="text-center">Inscription</h1>
    <form method="POST" action="tt_inscription.php">
        <div class="row my-3 justify-content-center">
            <div class="col-md-3" >
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-outline-primary" type="submit">Inscription</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
include 'footer.inc.php';
?>
<?php
session_start();
$titre = "Inscription";
include 'header.inc.php';
include 'menu.inc.php';
?>
<link rel="stylesheet" href="inscription.css">
<div class="container my-5 justify-center">
    <h1 class="text-center">Inscription</h1>
    <form method="POST" action="tt_inscription.php">
        <div class="row my-3 justify-content-center">
            <div class="col-md-3" >
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-outline-primary" type="submit">Inscription</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
include 'footer.inc.php';
?>
