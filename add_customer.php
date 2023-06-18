<?php
// <!-- Ce fichier permet d'ajouter un nouveau client. -->

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

// Récupérer l'id de l'advisor qui ajoute le client
$sqlGetAdvisorId = "SELECT id FROM advisors WHERE email = :advisorEmail";
$queryGetAdvisorId = $db->prepare($sqlGetAdvisorId);
$queryGetAdvisorId->bindValue(':advisorEmail', $email, PDO::PARAM_STR);
$queryGetAdvisorId->execute();
$advisorId = $queryGetAdvisorId->fetchColumn();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $birthdate = $_POST['birth_date'];
    $address = $_POST['address'];
    $address2 = $_POST['address_comp'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $advisorId = $_POST['advisors_id'];

    // Définir la valeur par défaut de gpdr
    $gpdr = 0;

    // Insérer les données en base de données
    $sqlInsertClient = "INSERT INTO customers (lastname, firstname, email, birth_date, address, address_comp, zip, city, phone, advisors_id, gpdr) 
                        VALUES (:lastname, :firstname, :email, :birthdate, :address, :address2, :zip, :city, :phone, :advisorId, :gpdr)";
    $queryInsertClient = $db->prepare($sqlInsertClient);
    $queryInsertClient->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':email', $email, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':address', $address, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':address2', $address2, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':zip', $zip, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':city', $city, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':phone', $phone, PDO::PARAM_STR);
    $queryInsertClient->bindValue(':advisorId', $advisorId, PDO::PARAM_INT);
    $queryInsertClient->bindValue(':gpdr', $gpdr, PDO::PARAM_INT);

    if ($queryInsertClient->execute()) {
        // Rediriger vers home.php
        header("Location: home.php");
        exit();
    } else {
        // Gérer l'erreur d'insertion en base de données
        echo "Une erreur s'est produite lors de l'ajout du client en base de données.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ajouter un client</title>
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
        <h3>AJOUTER UN CLIENT</h3>
        <div>
            <form method="POST" id="registerForm">
                <div>
                    <label>Nom :</label>
                    <input type="text" name="lastname" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Prénom :</label>
                    <input type="text" name="firstname" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Email :</label>
                    <input type="email" name="email" required />
                    <span>(Format attendu: adresse email)</span>
                </div>
                <div>
                    <label>Date de naissance :</label>
                    <input type="text" name="birth_date" required />
                    <span>(Format attendu: yyyy-mm-dd)</span>
                </div>
                <div>
                    <label>Adresse :</label>
                    <input type="text" name="address" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Complément d'adresse :</label>
                    <input type="text" name="address_comp" />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Code Postal :</label>
                    <input type="text" name="zip" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Ville :</label>
                    <input type="text" name="city" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <label>Téléphone :</label>
                    <input type="text" name="phone" required />
                    <span>(Format attendu: texte)</span>
                </div>
                <div>
                    <!-- CONSEILLER ATTRIBUÉ  -->
                    <label>CONSEILLER :</label>
                    <select name="advisors_id" id="advisors_">
                        <option value="<?php echo $advisorId; ?>"><?php echo $advisorId; ?></option>
                    </select>
                </div>
                <div></div>
                <div>
                    <button type="submit" name="submit">Ajouter le client</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>