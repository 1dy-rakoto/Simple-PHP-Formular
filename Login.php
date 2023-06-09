<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once("db_connection.php");

// Vérification de la soumission du formulaire
if (isset($_POST["login-btn"])) {
    // Récupération des données du formulaire
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Préparation de la requête SQL
    $query = "SELECT * FROM user WHERE name = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    // Exécution de la requête SQL en passant les paramètres en arguments
    $stmt->execute([$name]);

    // Récupération de la première ligne de résultat
    $data = $stmt->fetch();

    // Vérification du mot de passe
    //var_dump(password_verify($password, $data["password"]));
    if ($data != null && password_verify($password, $data["password"])) {
        // Authentification réussie
        $_SESSION["userName"] = $data["name"];

        // Redirection vers la page d'accueil
        header("Location: home.php");
        exit();
    } else {
        // Authentification échouée
        $error = "Either the name or the password is incorrect!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container form-container">
        <form action="#" method="post">
            <h2>Login now</h2>
            <?php if (isset($error)) { ?>
                <span class="error-msg"><?= $error ?></span>
            <?php } ?>
            <input type="text" name="name" placeholder="Enter your name" required><br>
            <input type="password" name="password" placeholder="Enter your password" required><br>
            <button type="submit" name="login-btn" class="btn">Login now</button>
            <div>Don't have an account? <a href="./register.php">Register now</a></div>
        </form>
    </div>
</body>
</html>
