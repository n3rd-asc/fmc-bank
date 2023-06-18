<?php
// <!-- Ce fichier est le tableau de bord qui affiche tous les clients du conseiller connecté. -->

// On se connecte à la base de données
require 'includes/connection.php';

// On démarre la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['email'])) {
    // Récupérer l'e-mail de l'utilisateur connecté
    $email = $_SESSION['email'];

    // Requête SQL pour sélectionner le nom et le prénom de l'advisor en fonction de l'email
    $sql = 'SELECT lastname, firstname, id FROM advisors WHERE email = :email';

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);

    // Exécution de la requête
    $query->execute();

    // Récupération des résultats
    $advisor = $query->fetch(PDO::FETCH_ASSOC);

    // Requête SQL pour récupérer la liste des clients de l'utilisateur connecté
    $sql = "SELECT * FROM customers WHERE advisors_id = :advisor_id";

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':advisor_id', $advisor['id'], PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Récupération des résultats
    $customers = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tableau de bord</title>
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
            <li><a class="account-actions" href="add_customer.php?advisor_id=<?php echo $advisor['id']; ?>">Ajouter un client</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div></div>
    <p>Bienvenue, <?php echo $advisor['lastname'] . ' ' . $advisor['firstname']; ?>.</p>
    <h2>TABLEAU DE BORD</h2>

    <table>
        <thead>
            <tr>
                <th>NOM</th>
                <th>PRÉNOM</th>
                <th>ADRESSE</th>
                <th>CODE POSTAL</th>
                <th>VILLE</th>
                <th>TÉLÉPHONE</th>
                <th>GÉRER</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['lastname']; ?></td>
                    <td><?php echo $customer['firstname']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['zip']; ?></td>
                    <td><?php echo $customer['city']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td>
                        <a class="links" href="accounts.php?customer_id=<?php echo $customer['id']; ?>">Comptes Bancaires</a>
                        <a class="links" href="edit_customer.php?customer_id=<?php echo $customer['id']; ?>">Modifier le compte client</a>
                        <a class="links" href="del_customer.php?customer_id=<?php echo $customer['id']; ?>">Supprimer le compte client</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
