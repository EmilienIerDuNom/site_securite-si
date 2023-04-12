<?php
require("config/config.php");
?>
<!DOCTYPE html>
<html>
<?php
$erreur = '';
?>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/style2.css" media="all" type="text/css">
</head>

<fieldset>

    <body>
        <form action="" method="post">
            <h1> Connexion </h1> <br>
            <input type="text" name="mail" placeholder="E-mail"> <br>
            <br>
            <input type="password" name="mdp" placeholder="Mot de passe"> <br>
            <br>
            <input type="submit" value="Entré"><br>
            <?php
            echo $erreur;
            ?>
        </form>

        <?php

        if (!empty($_POST['mail']) && !empty($_POST['mdp'])) // Si il existe les champs email, password et qu'il sont pas vident
        {
            $email = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['mdp']);

            $email = strtolower($email); // email transformé en minuscule
        
            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?');
            $check->execute(array($email));
            $data = $check->fetch();
            $row = $check->rowCount();



            // Si > à 0 alors l'utilisateur existe
            if ($row > 0) {
                // Si le mail est bon niveau format
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Si le mot de passe est le bon
                    if (hash('sha256', $password) === $data['mdp']) {
                        // On créer la session et on redirige sur index.php
                        $_SESSION['mail'] = $email;
                        $_SESSION['connecter'] = "connecter";
                        header('Location: index.php');
                    } else {
                        echo "<br>";
                        echo "E-mail ou mot de passe incorrect";
                    }
                } else {
                    echo "<br>";
                    echo "E-mail ou mot de passe incorrect";
                }
            } else {
                echo "<br>";
                echo "E-mail ou mot de passe incorrect";
            }
        } else {
            echo "<br>";
            echo "Veuillez saisir votre e-mail et votre mot de passe";
        }
        ?>
        <div class="drop drop-1"></div>
        <div class="drop drop-2"></div>
        <div class="drop drop-3"></div>
        <div class="drop drop-4"></div>
        <div class="drop drop-5"></div>
    </body>
</fieldset>