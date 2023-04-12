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
        $data = $bdd->prepare('SELECT * FROM blog');
        $data->execute();
        $blog = $data->fetchAll();

        $id = $_REQUEST['id'];
        $titre = $_REQUEST['titre'];
        $image = $_REQUEST['image'];
        $text = $_REQUEST['text'];
        ?>
        <form method="post" enctype="multipart/form-data">
            Modifier le titre
            <input type="text" name="titre" value="<?php echo $titre; ?> ">
            Modifier l'image
            <input type="file" name="image">
            Modifier le text
            <input type="text" name="text" value="<?php echo $text; ?> ">
            <input type="submit" value="Entrer" name="submit">
        </form>


        <?php
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Vérifier si un fichier a bien été envoyé
    
        $titre = $_POST['titre'];
        $text = $_POST['text'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Vérifier que le fichier est une image
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($file_extension, $allowed_types)) {
                // Déplacer le fichier dans le dossier d'upload
                $upload_dir = 'img/';
                $filename = uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $filename;

                $req = $bdd->prepare("UPDATE `blog` SET `titre` = ?,`image` = ?, `text` = ? WHERE `id` = ?;");
                $req->execute(array($titre, $filename, $text, $id));

                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    // Le fichier a été uploadé avec succès
                    echo 'Le fichier a été uploadé avec succès.';
                } else {
                    // Une erreur est survenue lors de l'upload
                    echo 'Une erreur est survenue lors de l\'upload du fichier.';
                }
            } else {
                // Le fichier n'est pas une image
                echo 'Le fichier doit être une image (jpg, jpeg, png ou gif).';
            }
        } else {
            // Aucun fichier n'a été envoyé
            echo 'Veuillez sélectionner un fichier à uploader.';
        }
    }
    ?>
    <a href="index.php">Retour</a>
</body>