<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Page de Connexion</title>
</head>
<body>
    <div class="main">
        <img src="img/cadenas (1).png" alt="" class="locker">
        <h1>Connexion</h1>
        <form method="post" action="connexion.php">
            <input class="user" placeholder="Adresse Email" type="email" id="username" name="username" required><br><br>
            
            <input class="pass" placeholder="Mot de passe" type="password" id="password" name="password" required><br><br>
            <a href="" class="forget">Mot de passe</a>
            
            <input class="btn" type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
<?php
session_start();

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo 'Les champs "Adresse Email" et "Mot de passe" doivent être remplis.';
    } else {
        try {
            $host = 'localhost'; 
            $db = 'utilisateurs';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $databaseDsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $pdo = new PDO($databaseDsn, $user, $pass);

            $user_input_username = $_POST['username'];
            $user_input_password = $_POST['password'];

            $stmt = $pdo->prepare("SELECT username, password_hash FROM utilisateurs WHERE username = :username");
            $stmt->bindParam(':username', $user_input_username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $password_hash = $row['password_hash'];

                if (password_verify($user_input_password, $password_hash)) {
                    $_SESSION['username'] = $user_input_username; 
                    header('Location: index.php');
                    exit;
                } else {
                    echo 'Mot de passe incorrect.';
                }
            } else {
                echo 'Nom d\'utilisateur non trouvé.';
            }
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}
?>
</html>


