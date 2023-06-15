<?php
// Quand l'utilisateur est connecté

// On se connecte à la base de données
require 'includes/connection.php';
// On démarre la session
session_start();

$email = $_SESSION['email']; // On utilise l'email comme identifiant

// On écrit le SQL pour sélectionner le nom et le prénom de l'advisor en fonction de l'email
$sql = 'SELECT lastname, firstname FROM advisors WHERE email = :email';

// prepare
$query = $db->prepare($sql);

// bind
$query->bindValue(':email', $email, PDO::PARAM_STR);

// execute
$query->execute();

$advisor = $query->fetch(PDO::FETCH_ASSOC);


//Récupération de la liste des clients depuis la base de données

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
    <link rel="stylesheet" href="./css/styles.min.css">
</head>

<body>
    <nav>
        <div>
            <a href=""><svg height="50" width="50">
                    <circle cx="50" cy="50" r="40" stroke="#333" stroke-width="3" fill="#fff" />
                </svg> FMC Parisud</a>
        </div>
    </nav>
    <div>
        <h3>Tableau de bord</h3>
        <div>
            <h3>Welcome, <?php echo $advisor['lastname'] . ' ' . $advisor['firstname']; ?> !</h3>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <h2>LISTE DES CLIENTS :</h2>

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
                <th></th>
                <th></th>
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
                    <td> <button>Comptes</button> </td>
                    <td><button>Modifier</button></td>
                    <td><button>Supprimer</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>