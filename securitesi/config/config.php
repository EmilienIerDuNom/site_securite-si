<!-- Connexion base de donnée -->
<?php
$dbname = "securitesi_sql";
$dbpass = "";
$dbuser = "root";
$dbip = "localhost";

$bdd = new PDO("mysql:host=$dbip;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
