<?php
    require "Model/play_quizz.php";

   // $id = $_GET['id'];
    //$data = getPlayQuizz($pdo, $id);

    //echo($id);
    //var_dump($data);
    

    $errors = [];
    $quizzTotal = [];

    if (!empty($_GET['id'])) {
        $id = (int) $_GET['id'];
        $quizzTotal = getPlayQuizz($pdo, $id);

        if (!is_array($quizzTotal)) {
            $errors = $quizzTotal;
        }
    }

    // Vérification si c'est une requête AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){        
        header('Content-Type: application/json');
        echo json_encode($quizzTotal);
        exit;
    }


    require "View/play_quizz.php";
?>