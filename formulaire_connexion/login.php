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
        <form method="post" action="">
            <input class="user" placeholder="Adresse Email" type="email" id="username" name="username" required><br><br>
            
            <input class="pass" placeholder="Mot de passe" type="password" id="password" name="password" required><br><br>
            <a href="" class="forget">Mot de passe</a>
            
            <input class="btn" type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        echo 'Le champ "Nom d\'utilisateur" doit être rempli.';
    } else {
        $utilisateur = [
            'username' => 'user@gmail.com',
            'password' => 'user',
        ];

        $user_input_username = $_POST['username'];
        $user_input_password = $_POST['password'];

        if ($user_input_username === $utilisateur['username'] && $user_input_password === $utilisateur['password']) {
            header('Location: index.php');
            exit;
        } else {
            echo 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
}
?>
</html>
