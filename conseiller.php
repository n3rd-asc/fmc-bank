<?php
// FICHIER DE RÉF

//On affichera 1 conseiller
var_dump($_GET['id']);
// Je vérifie que j'ai un id dans l'url
if (empty($_GET['id'])) {
    // Si pas d'id on redirige vers index.php
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Je vérifie si l'id est numérique
if (!is_numeric($id)) {
    die('ID Invalid');
}

// Injection SQL
// conseiller.php?id=3; DROP DATABASE demodelete; --

// On se connecte à la base de données
// include 'includes/connection.php';
// include_once 'includes/connection.php';
// require 'includes/connection.php';
require_once 'includes/connection.php';

// On écrit le SQL
$sql = "SELECT * FROM `advisors` WHERE `id` = :id;";

// Y a-t-il des données venant de l'utilisateur dans ma requête ?
// Non : Je peux exécuter directement (query)
// Oui : Je DOIS préparer ma requête (prepare)
// prepare -> bind -> execute

// prepare
$query = $db->prepare($sql);

// bind
$query->bindValue(':id', $id, PDO::PARAM_INT);

// execute
$query->execute();

$advisor = $query->fetch(PDO::FETCH_ASSOC);

var_dump($advisor);
