<?php
require("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/style.css" media="all" type="text/css">
    <title>Accueil</title>
</head>

<body>
    <h1>Bienvenue !</h1>
    <?php
    if ($_SESSION['connecter'] == "connecter") {
        echo "<a href='deco.php'>Se déconnecter</a>";
    } else {
        echo "<a href='connexion.php'>Se connecter </a>";
        echo "<a href='inscription.php'>S'inscire </a>";
    }
    ?>

    <?php
    $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?');
    $check->execute(array($_SESSION['mail']));
    $data = $check->fetch();
    if ($data['permissions'] === 1 && $_SESSION['connecter'] == "connecter") {
        echo "<a href='importer.php'>Ajouter un nouveau blog</a>";
        $data = $bdd->prepare('SELECT * FROM blog');
        $data->execute();
        $blog = $data->fetchAll();
        ?>
        <ul>
            <?php

            foreach ($blog as $blog => $bg) { ?>
                <li>
                    <?= $bg['titre']; ?>
                </li>
                <img src="img/<?= $bg['image']; ?>">
                <li>
                    <?= $bg['text']; ?>
                </li>
                <li><a href="modif.php?titre=<?= $bg['titre'] ?>&image=<?= $bg['image'] ?>&text=<?= $bg['text'] ?>&id=<?= $bg['id'] ?>">Modifier ce blog</a> </li>
                <li><a href="supr.php?id=<?= $bg['id'] ?>">Supprimer ce blog</a></li>
            </ul>
        <?php
            }
    } else {
        ?>


        <div>
            <?php
            $data = $bdd->prepare('SELECT * FROM blog');
            $data->execute();
            $blog = $data->fetchAll();
            ?>
            <ul>
                <?php

                foreach ($blog as $blog => $bg) { ?>
                    <li>
                        <?php echo $bg['titre']; ?>
                    </li>
                    <img src="img/<?php echo $bg['image']; ?>">
                    <li>
                        <?php echo $bg['text']; ?>
                    </li>

                <?php
                }
    }
    ;
    ?>

        </ul>
    </div>
</body>

</html>