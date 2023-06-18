<?php
// Ce fichier permet de forcer la suppression du clients en supprimant les comptes associés

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

// Supprimer les comptes associés au client
$sqlDeleteAccounts = "DELETE FROM accounts WHERE costumers_id = :customer_id";
$queryDeleteAccounts = $db->prepare($sqlDeleteAccounts);
$queryDeleteAccounts->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
$queryDeleteAccounts->execute();

// Requête SQL pour supprimer le client
$sqlDeleteCustomer = "DELETE FROM customers WHERE id = :customer_id AND advisors_id = (SELECT id FROM advisors WHERE email = :email)";

// Préparation de la requête
$queryDeleteCustomer = $db->prepare($sqlDeleteCustomer);
$queryDeleteCustomer->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
$queryDeleteCustomer->bindValue(':email', $email, PDO::PARAM_STR);

// Exécution de la requête pour supprimer le client
$queryDeleteCustomer->execute();

// Rediriger vers le tableau de bord home.php après la suppression
header("Location: home.php");
exit();
?>
