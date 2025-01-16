<?php
    require "Model/login.php";
    
if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){
    $errors = [];
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $pass = !empty($_POST['password']) ? $_POST['password'] : null;
        //var_dump($username);
        //var_dump($pass);

    if(null === $username || null === $pass) {
        $errors[] = "identifiant ou mot de passe vide";
    } else {
        $connexion = connect($pdo, $username);
        //var_dump($connexion);
        //if (empty($connexion) || !password_verify($pass, $connexion['password'])) {
        //    $errors[] = "Erreur d'identification, veuillez essayer à nouveau";
        //} 
        if (empty($connexion)) {
            $errors[] = "Utilisateur introuvable.";
        } elseif (!password_verify($pass, $connexion['password'])) {
            $errors[] = "Mot de passe incorrect.";
        }else {
            $_SESSION["auth"] = true;
            $_SESSION["username"] = $connexion['username'];
            header("Content-Type: application/json");
            echo json_encode(['authentication' => true]);
            exit();
        }
    }

    if (!empty($errors)) {
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}

    require "View/login.php";
?>