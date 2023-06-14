<?php
// Ce fichier liste les conseillers

// On se connecte à la base
// include 'includes/connect.php';
// include_once 'includes/connect.php';
// require 'includes/connect.php';
require_once 'includes/connection.php';

// On écrit le SQL
$sql = 'SELECT * FROM `advisors`;';

// Y a-t-il des données venant de l'utilisateur dans ma requête ?
// Non : je peux exécuter directement (query)
// Oui : je DOIS préparer ma requête (prepare)
$query = $db->query($sql);

// Après un SELECT, on doit récupérer les données
$advisors = $query->fetchAll(PDO::FETCH_ASSOC);

// APRES un fetchAll, il y a toujours une boucle
foreach($advisors as $advisor) {
    echo "<h1>{$advisor['lastname']}</h1>";
    echo "<h2>{$advisor['firstname']}</h2>";
    echo "<h3>{$advisor['email']}</h3>";
    echo "<h4>{$advisor['password']}</h4>";
    
}