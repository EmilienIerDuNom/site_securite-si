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
    <?php 
    $_SESSION['connecter'] = '';
    header('Location: index.php');
    ?>
</body>