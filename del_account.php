<?php
// Ce fichier permet de supprimer un compte bancaire

// On se connecte à la base de données
require 'includes/connection.php';

// Vérifier si l'identifiant du compte est présent dans l'URL
if (isset($_GET['account_id'])) {
    // Récupérer l'identifiant du compte depuis l'URL
    $account_id = $_GET['account_id'];

    // Requête SQL pour récupérer l'ID du client correspondant au compte bancaire
    $sql = "SELECT costumers_id FROM accounts WHERE id = :account_id";

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':account_id', $account_id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Récupération du résultat
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Vérifier si un résultat a été obtenu
    if ($result) {
        // Récupérer l'ID du client
        $customer_id = $result['costumers_id'];

        // Requête SQL pour supprimer le compte bancaire correspondant à l'identifiant
        $sql = "DELETE FROM accounts WHERE id = :account_id";

        // Préparation de la requête
        $query = $db->prepare($sql);
        $query->bindValue(':account_id', $account_id, PDO::PARAM_INT);

        // Exécution de la requête
        $query->execute();

        // Redirection vers la page des comptes avec l'ID du client dans l'URL
        header("Location: accounts.php?customer_id=" . $customer_id);
        exit();
    }
}

// Redirection vers la page accounts.php si l'ID du client n'a pas été récupéré
header("Location: accounts.php");
exit();
