<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=creation_quizz','root');
} catch (Exception $e) {
    $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
}
?>