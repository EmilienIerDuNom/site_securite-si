<?php
require("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/styleV.css" media="all" type="text/css">
    <title>Accueil</title>
</head>

<body>
    <fieldset>
        <h1>Bienvenue !</h1>
        <?php
        if (isset($_SESSION['connecter'])) {
        if ($_SESSION['connecter'] == "connecter") {
            echo "<a href='deco.php'>Se déconnecter</a> ";
        } else {
            echo " <br><a href='connexion.php'>Se connecter </a><br><br> ";
            echo " <br><a href='inscription.php'>S'inscire </a><br> ";
        }} else {
            echo " <br><a href='connexion.php'>Se connecter </a><br><br> ";
            echo " <br><a href='inscription.php'>S'inscire </a><br> ";
        }
        ?>

        <?php
        if (isset($_SESSION['mail'])) {
        $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?');
        $check->execute(array($_SESSION['mail']));
        $data = $check->fetch();}
        if (isset($data['permissions']) && isset($_SESSION['connecter'])) {
        if ($data['permissions'] === 1 && $_SESSION['connecter'] == "connecter") {
            echo "<a href='importer.php'>Ajouter un nouveau blog</a>";
            $data = $bdd->prepare('SELECT * FROM blog');
            $data->execute();
            $blog = $data->fetchAll();
            ?>
            <ul>
                <?php

                foreach ($blog as $blog => $bg) { ?>
                    <br>
                    <h3>
                        <?= $bg['titre']; ?>
                    </h3>
                    <br>
                    <img src="img/<?= $bg['image']; ?>">
                    <br>
                    <?= $bg['text']; ?>
                    <br>
                    <br> <a
                        href="modif.php?titre=<?= $bg['titre'] ?>&image=<?= $bg['image'] ?>&text=<?= $bg['text'] ?>&id=<?= $bg['id'] ?>">Modifier
                        ce blog</a> <br><br>
                    <br><a href="supr.php?id=<?= $bg['id'] ?>">Supprimer ce blog</a>
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
        }}
        ;
        ?>

            </ul>
        </div>
    </fieldset>
</body>

</html>