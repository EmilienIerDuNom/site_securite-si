<?php
require("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/style.css" media="all" type="text/css">
    <title>Suprimer un blog</title>
</head>

<body>
    <?php
    $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?');
    $check->execute(array($_SESSION['mail']));
    $data = $check->fetch();
    if ($data['permissions'] === 0) {
        echo "Désolé, vous n'avez pas les permissions requises pour cette actions";
    } else {
        $id = $_REQUEST['id'];

        $listage = $bdd->query('SELECT * FROM blog');

        $list = $listage->fetch();
        $bdd->query("DELETE FROM `blog` WHERE id = " . $id . "");

        header('Location: index.php');
    } ?>
</body>