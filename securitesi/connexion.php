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
    <link rel="stylesheet" href="style/style.css" media="all" type="text/css">
</head>

<body>
    <form action="" method="post">
        <input type="text" name="mail" placeholder="E-mail">
        <input type="password" name="mdp" placeholder="Mot de passe">
        <input type="submit" value="Entré">
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
                if (hash( 'sha256', $password) === $data['mdp']) {
                    // On créer la session et on redirige sur index.php
                    $_SESSION['mail'] = $email;
                    $_SESSION['connecter']="connecter";
                    header('Location: index.php');
                } else {
                    echo "E-mail ou mot de passe incorrect";
                }
            } else {
                echo "E-mail ou mot de passe incorrect";
            }
        } else {
            echo "E-mail ou mot de passe incorrect";
        }
    } else {
        echo "Veuillez saisir votre e-mail et votre mot de passe";
    }
    ?>
</body>