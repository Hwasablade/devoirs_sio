<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style_inscription.css">
</head>
<body>
    <div class="main">
        <h1>Inscription</h1>
        <form method="POST" action="inscription.php">
            <label for="nom">Nom:</label>
            <input class="user" type="text" name="nom" required><br>

            <label for="prenom">Prénom:</label>
            <input class="user" type="text" name="prenom" required><br>

            <label for="email">Email:</label>
            <input class="user" type="email" name="email" required><br>

            <label for="mot_de_passe">Mot de passe:</label>
            <input class="pass" type="password" name="mot_de_passe" required><br>

            <input class="btn" type="submit" value="S'inscrire">
        </form>
    </div>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db = 'utilisateurs';
    $user = 'root';
    $charset = 'utf8mb4';

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=utilisateurs;charset=utf8mb4", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); 

    $existingUserQuery = $pdo->prepare('SELECT id FROM utilisateurs WHERE email = :email');
    $existingUserQuery->execute(['email' => $email]);
    $existingUser = $existingUserQuery->fetch();

    if ($existingUser) {
        echo 'L\'adresse e-mail existe déjà. Veuillez choisir une autre adresse e-mail.';
    } else {
        $insertQuery = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)');
        
        $insertQuery->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe
        ]);
        
        header('Location: connexion.php');
        exit();
    }
}
?>
</html>
