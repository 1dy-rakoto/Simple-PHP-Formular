<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=user_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
