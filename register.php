<?php
require_once("db_connection.php");

if (isset($_POST["register-btn"])){
    $name = $_POST["name"];
    $email = $_POST["mail"];
    $password = $_POST["password"];
    $cpassword = $_POST["confirmPassword"];

    $query = "SELECT * FROM user WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);

    $error = array();

    if($stmt->fetch() != null){
        array_push($error,"User already exists!");
    }else{
        if($password != $cpassword){
            array_push($error,"Passwords do not match!");
        }else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$name, $email, $hashed_password]);
            header("Location: login.php");
            exit();
        }
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
    <title>Register</title>
</head>
<body>
    <div class="container form-container">
        <form action="#" method="post">
            <h2>Register now</h2>
            <?php
            if (isset($error)){
                foreach ($error as $e){
                   echo '<span class="error-msg">'.$e.'</span>';
                }
            }
            ?>
            <input type="text" name="name" placeholder="Enter your name" required><br>
            <input type="email" name="mail" placeholder="Enter your email" required><br>
            <input type="password" name="password" placeholder="Enter your password" required><br>
            <input type="password" name="confirmPassword" placeholder="Confirm your password" required><br>
            <button type="submit" name="register-btn" class="btn">Register now</button><br>
            <div>Already have an account? <a href="login.php">Login now</a></div>
        </form>
    </div>
</body>
</html>
