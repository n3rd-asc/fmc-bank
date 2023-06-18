<?php
// Ce fichier permet d'ajouter un nouveau compte au client selectionné

// On se connecte à la base de données
require 'includes/connection.php';
// On démarre la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email']; // On utilise l'email comme identifiant

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $type = $_POST['type'];
    $balance = $_POST['balance'];
    $overdraft = $_POST['overdraft'];

    // Insérer les données en base de données
    $sqlInsertAccount = "INSERT INTO accounts (type, balance, overdraft, costumers_id)
                        VALUES (:type, :balance, :overdraft, :customerId)";
    $queryInsertAccount = $db->prepare($sqlInsertAccount);
    $queryInsertAccount->bindValue(':type', $type, PDO::PARAM_STR);
    $queryInsertAccount->bindValue(':balance', $balance, PDO::PARAM_STR);
    $queryInsertAccount->bindValue(':overdraft', $overdraft, PDO::PARAM_STR);
    $queryInsertAccount->bindValue(':customerId', $_GET['customer_id'], PDO::PARAM_INT);

    if ($queryInsertAccount->execute()) {
        // Rediriger vers accounts.php avec l'ID du client dans l'URL
        header("Location: accounts.php?customer_id=" . $_GET['customer_id']);
        exit();
    } else {
        // Erreur
        echo "Une erreur s'est produite lors de l'ajout du compte en base de données.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ajouter un compte</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.min.css">
</head>

<body>
    <nav>
        <div>
            <a href=""><svg height="50" width="50">
                    <circle cx="50" cy="50" r="40" stroke="#333" stroke-width="3" fill="#fff" />
                </svg> FMC Parisud</a>
        </div>
        <ul id="advisor-actions" style="list-style-type: none; display:flex;">
            <li><a class="account-actions" href="home.php">Tableau de bord</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div>
        <div></div>
        <h3>AJOUTER UN COMPTE</h3>
        <div>
            <form method="POST" id="addAccountForm">
                <div>
                    <label>Type de compte :</label>
                    <select name="type" required>
                        <option value="Livret A">Livret A</option>
                        <option value="Compte Courant">Compte Courant</option>
                        <option value="Plan Épargne Logement">Plan Épargne Logement</option>
                    </select>
                </div>
                <div>
                    <label>Solde :</label>
                    <input type="text" name="balance" required />
                    <span>(Format attendu: nombre décimal)</span>
                </div>
                <div>
                    <label>Découvert autorisé :</label>
                    <input type="text" name="overdraft" required />
                    <span>(Format attendu: nombre entier)</span>
                </div>
                <div></div>
                <div>
                    <button type="submit" name="submit">Ajouter le compte</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>