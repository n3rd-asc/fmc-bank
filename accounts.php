<?php
// Quand l'utilisateur est connecté

// On se connecte à la base de données
require 'includes/connection.php';
// On démarre la session
session_start();

$email = $_SESSION['email']; // On utilise l'email comme identifiant

// On écrit le SQL pour sélectionner le nom et le prénom de l'advisor en fonction de l'email
$sql = 'SELECT lastname, firstname FROM advisors WHERE email = :email';

// Préparation de la requête
$query = $db->prepare($sql);

// Attribution de la valeur à la variable :email
$query->bindValue(':email', $email, PDO::PARAM_STR);

// Exécution de la requête
$query->execute();

$advisor = $query->fetch(PDO::FETCH_ASSOC);


// Récupération de la liste des clients depuis la base de données

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['email'])) {
    // Récupérer l'e-mail de l'utilisateur connecté
    $email = $_SESSION['email'];

    // Requête SQL pour récupérer la liste des clients de l'utilisateur connecté
    $sql = "SELECT * FROM customers WHERE advisors_id = (SELECT id FROM advisors WHERE email = :email)";

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);

    // Exécution de la requête
    $query->execute();

    // Récupération des résultats
    $customers = $query->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si l'identifiant du client est présent dans l'URL
    if (isset($_GET['customer_id'])) {
        // Récupérer l'identifiant du client depuis l'URL
        $customer_id = $_GET['customer_id'];

        // Requête SQL pour récupérer les informations du client sélectionné
        $sql = "SELECT * FROM customers WHERE id = :customer_id";

        // Préparation de la requête
        $query = $db->prepare($sql);
        $query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);

        // Exécution de la requête
        $query->execute();

        // Récupération des résultats
        $selected_customer = $query->fetch(PDO::FETCH_ASSOC);

        // Requête SQL pour récupérer les comptes du client sélectionné
        $sql = "SELECT * FROM accounts WHERE costumers_id = :customer_id";

        // Préparation de la requête
        $query = $db->prepare($sql);
        $query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);

        // Exécution de la requête
        $query->execute();

        // Récupération des résultats
        $accounts = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Détail des Comptes :</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.min.css">
</head>

<body>
    <nav>
        <div>
            <a href=""><svg height="50" width="50">
                    <circle cx="50" cy="50" r="40" stroke="#333" stroke-width="3" fill="#fff" />
                </svg> FMC Parisud</a>
        </div>

        <ul id="advisor-actions" style="list-style-type: none; display:flex;">
            <li><a class="account-actions" href="#">Ajouter un compte</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>

        </ul>
    </nav>
    <div>
        <div>
            <!-- <h3>Welcome, <?php echo $advisor['lastname'] . ' ' . $advisor['firstname']; ?> !</h3> -->
        </div>
    </div>

    <p>Bienvenue, <?php echo $advisor['lastname'] . ' ' . $advisor['firstname']; ?>.</p>
    <h2>DÉTAIL DES COMPTES :</h2>

    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Type de compte</th>
                <th>Solde</th>
                <th>Découvert autorisé</th>
                <th>Gérer le compte</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($selected_customer)) : ?>
                <?php $customer = $selected_customer; ?>
                <?php foreach ($accounts as $account) : ?>
                    <tr>
                        <td><?php echo $customer['lastname'] . ' ' . $customer['firstname']; ?></td>
                        <td><?php echo $account['type']; ?></td>
                        <td><?php echo $account['balance']; ?></td>
                        <td><?php echo $account['overdraft']; ?></td>
                        <td><a class="links" href="#">Effectuer un dépôt</a>
                        <a class="links" href="#">Effectuer un retrait</a>
                        <a class="links" href="#">Autorisation de découvert</a>
                        <a class="links" href="#">Fermer le compte</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($customers as $customer) : ?>
                    <?php
                    // Requête SQL pour récupérer les comptes du client
                    $sql = "SELECT * FROM accounts WHERE costumers_id = :customer_id";

                    // Préparation de la requête
                    $query = $db->prepare($sql);
                    $query->bindValue(':customer_id', $customer['id'], PDO::PARAM_INT);

                    // Exécution de la requête
                    $query->execute();

                    // Récupération des résultats
                    $accounts = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($accounts as $account) : ?>
                        <tr>
                            <td><?php echo $customer['lastname'] . ' ' . $customer['firstname']; ?></td>
                            <td><?php echo $account['type']; ?></td>
                            <td><?php echo $account['balance']; ?></td>
                            <td><?php echo $account['overdraft']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>