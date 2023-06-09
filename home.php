<?php
require_once("db_connection.php");
session_start();
var_dump($_SESSION["userName"]);
if(!isset($_SESSION["userName"])){
    header("location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Welcome to the home page <span><?=$_SESSION["userName"]; ?></span></h2>
            <div><a  class="btn" href="logout.php">Logout</a></div>
        </div>
    </div>
</body>
</html>
