<?php
// Ce fichier permet d'éditer les informations d'un client

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

// Récupérer l'ID du client depuis l'URL
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
} else {
    // Rediriger vers une page d'erreur si l'ID du client n'est pas spécifié
    header("Location: error.php");
    exit();
}

// Requête SQL pour récupérer les détails du client
$sql = "SELECT * FROM customers WHERE id = :customer_id AND advisors_id = (SELECT id FROM advisors WHERE email = :email)";

// Préparation de la requête
$query = $db->prepare($sql);
$query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
$query->bindValue(':email', $email, PDO::PARAM_STR);

// Exécution de la requête
$query->execute();

// Récupération du résultat
$customer = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si le client existe et appartient à l'advisor connecté
if (!$customer) {
    // Rediriger vers une page d'erreur si le client n'existe pas ou n'appartient pas à l'advisor
    header("Location: error.php");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];

    // Requête SQL pour mettre à jour les informations du client
    $sql = "UPDATE customers SET firstname = :firstname, lastname = :lastname, email = :email, zip = :zip, city = :city, phone = :phone WHERE id = :customer_id";

    // Préparation de la requête
    $query = $db->prepare($sql);
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':zip', $zip, PDO::PARAM_STR);
    $query->bindValue(':city', $city, PDO::PARAM_STR);
    $query->bindValue(':phone', $phone, PDO::PARAM_STR);
    $query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Rediriger vers le tableau de bord home.php
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier le compte client</title>
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
            <li><a class="account-actions" href="home.php">Tableau de bord</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div></div>
    <h2>MODIFIER LE COMPTE CLIENT</h2>
    <form method="POST" action="">
        <div></div>
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $customer['lastname']; ?>" required>
        </div>
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $customer['firstname']; ?>" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" required>
        </div>
        <div>
            <label for="zip">Code postal :</label>
            <input type="text" id="zip" name="zip" value="<?php echo $customer['zip']; ?>" required>
        </div>
        <div>
            <label for="city">Ville :</label>
            <input type="text" id="city" name="city" value="<?php echo $customer['city']; ?>" required>
        </div>
        <div>
            <label for="phone">Téléphone :</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $customer['phone']; ?>" required>
        </div>
        <div>
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>
    </div>
</body>

</html>