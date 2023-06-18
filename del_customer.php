<?php
// Ce fichier permet de supprimer un client sauf s'il a des comptes bancaires associés

// On se connecte à la base de données
require 'includes/connection.php';
// On démarre la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email']; // On utilise l'email comme identifiant

// Récupérer l'ID du client depuis l'URL
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
} else {
    // Rediriger vers une page d'erreur si l'ID du client n'est pas spécifié
    header("Location: error.php");
    exit();
}

// Vérifier si le client a des comptes bancaires associés
$sqlCheckAccounts = "SELECT COUNT(*) FROM accounts WHERE costumers_id = :customer_id";
$queryCheckAccounts = $db->prepare($sqlCheckAccounts);
$queryCheckAccounts->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
$queryCheckAccounts->execute();
$accountCount = $queryCheckAccounts->fetchColumn();

if ($accountCount > 0) {
    // Afficher le message d'erreur avec la confirmation pop-up
    echo "<script>
        if (confirm('Un client ne peut être supprimé s\'il dispose encore d\'un compte bancaire. Souhaitez-vous tout de même supprimer le client?')) {
            // Redirection vers le fichier de suppression du client même s'il a des comptes
            window.location.href = 'del_customer_force.php?customer_id=".$customer_id."';
        } else {
            // Redirection vers le tableau de bord home.php
            window.location.href = 'home.php';
        }
    </script>";
} else {
    // Requête SQL pour supprimer le client
    $sql = "DELETE FROM customers WHERE id = :customer_id AND advisors_id = (SELECT id FROM advisors WHERE email = :email)";

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
    $query->bindValue(':email', $email, PDO::PARAM_STR);

    // Exécution de la requête
    $query->execute();

    // Rediriger vers le tableau de bord home.php après la suppression
    header("Location: home.php");
    exit();
}
