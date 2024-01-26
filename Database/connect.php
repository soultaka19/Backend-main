<?php
    $servername = "localhost";
    $username = "root"; // Remplacer par votre nom d'utilisateur
    $password = ""; // Remplacer par votre mot de passe
    $dbname = "gestionLutteurs";

    try {
        // Création de la connexion
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Définir le mode d'erreur PDO sur exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Échec de la connexion: " . $e->getMessage();
    }
?>