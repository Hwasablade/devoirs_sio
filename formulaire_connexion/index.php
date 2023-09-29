
<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
</head>
<body>
    <h2>Bienvenue sur la page d'accueil</h2>
    <a href="">Acceuil</a>
    <form method="post" action="logout.php">
        <input type="submit" value="logout">
    </form>
    
</body>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo 'Vous êtes correctement connecter';
    exit;
}

?>
</html>
