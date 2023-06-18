<?php
// Ce fichier permet de modifier l'autorisation de découvert d'un compte

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

// Vérifier si le paramètre 'customer_id' est présent dans l'URL
if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];
} else {
    // Rediriger vers la page d'erreur si le paramètre est manquant
    header("Location: error.php");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $accountId = $_POST['account_id'];
    $overdraft = $_POST['overdraft'];

    // Vérifier si le compte appartient bien au client
    $sqlCheckAccount = "SELECT * FROM accounts WHERE id = :accountId AND costumers_id = :customerId";
    $queryCheckAccount = $db->prepare($sqlCheckAccount);
    $queryCheckAccount->bindValue(':accountId', $accountId, PDO::PARAM_INT);
    $queryCheckAccount->bindValue(':customerId', $customerId, PDO::PARAM_INT);
    $queryCheckAccount->execute();

    if ($queryCheckAccount->rowCount() > 0) {
        // Le compte appartient au client, procéder à la modification de l'autorisation de découvert
        $sqlUpdateOverdraft = "UPDATE accounts SET overdraft = :overdraft WHERE id = :accountId";
        $queryUpdateOverdraft = $db->prepare($sqlUpdateOverdraft);
        $queryUpdateOverdraft->bindValue(':overdraft', $overdraft, PDO::PARAM_STR);
        $queryUpdateOverdraft->bindValue(':accountId', $accountId, PDO::PARAM_INT);

        if ($queryUpdateOverdraft->execute()) {
            // Rediriger vers la page des comptes avec l'ID du client dans l'URL
            header("Location: accounts.php?customer_id=" . $customerId);
            exit();
        } else {
            // Gérer l'erreur de modification en base de données
            header("Location: error.php");
            exit();
        }
    } else {
        // Le compte n'appartient pas au client, rediriger vers la page d'erreur
        header("Location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tableau de bord :</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.min.css">
    <script src="js/validation.js" defer></script>
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
        <h3>MODIFIER L'AUTORISATION DE DÉCOUVERT</h3>
        <div>
            <form method="POST" id="overdraftForm">
                <div>
                    <label for="account">Choisissez le compte :</label>
                    <select name="account_id" required>
                        <!-- Liste des comptes appartenant au client -->
                        <?php
                        $sqlAccounts = "SELECT * FROM accounts WHERE costumers_id = :customerId";
                        $queryAccounts = $db->prepare($sqlAccounts);
                        $queryAccounts->bindValue(':customerId', $customerId, PDO::PARAM_INT);
                        $queryAccounts->execute();
                        while ($account = $queryAccounts->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $account['id'] . '">' . $account['type'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="overdraft">Autorisation de découvert :</label>
                    <input type="text" name="overdraft" required />
                </div>
                <div>
                    <button type="submit" name="submit">Modifier l'autorisation de découvert</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>