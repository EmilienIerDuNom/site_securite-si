<!-- Connexion base de donnée -->
<?php
$dbname = "securitesi_sql";
$dbpass = "";
$dbuser = "root";
$dbip = "localhost";

try
{
$bdd = new PDO("mysql:host=$dbip;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}


?>