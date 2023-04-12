<?php 
require("config/config.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style/style.css" media="all" type="text/css">
</head>
<fieldset>
<body>
    <?php 
    $valid ="";
    ?>

    <!-- Récupération des donnée -->
    <form action="inscription.php" method="post">
    <h1> Inscription </h1> <br>
        <br>
        <input type="text" required="required" name="nom" placeholder="Nom"> <br><br>
        <input type="text" required="required" name="prenom" placeholder="Prénom"><br><br>
        <input type="number" required="required" name="tel" placeholder="Téléphone"><br><br>
        <input type="email" required="required" name="mail" placeholder="E-mail"><br><br>
        <input type="password" required="required" name="mdp" placeholder="Mot de passe"><br><br>
        <input class="button-62" type="submit" value="Entrez"><br><br>
    </form>
    <!-- Envoie dans la base de donnée -->
    <?php

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['mdp'])) {
        $nom = $_REQUEST['nom'];
        $prenom = $_REQUEST['prenom'];
        $tel = $_REQUEST['tel'];
        $mail = $_REQUEST['mail'];
        $mdp = $_REQUEST['mdp'];
        $emdp = hash('sha256', $mdp);

        $inser = $bdd->prepare("INSERT INTO `utilisateurs` (nom, prenom, tel, mail, mdp) VALUES (? ,? ,? ,? ,?)");

        $inser->execute(array($nom, $prenom, $tel, $mail, $emdp));
        $valid = "Le compte a été correctement créer";
    }
    echo $valid;
    ?>
    <a href="connexion.php">Se connecter</a>
    <div class="drop drop-1"></div>
  <div class="drop drop-2"></div>
  <div class="drop drop-3"></div>
  <div class="drop drop-4"></div>
  <div class="drop drop-5"></div>
</body>
</fieldset>