<?php
    require "Model/play_quizz.php";

    $errors = [];
    $quizzTotal = [];

    if (!empty($_GET['id'])) {
        $id = (int) $_GET['id'];
        $quizzTotal = getPlayQuizz($pdo, $id);

        if (!is_array($quizzTotal)) {
            $errors = $quizzTotal;
        }
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){        
        header('Content-Type: application/json');
        echo json_encode($quizzTotal);
        exit;
    }


    require "View/play_quizz.php";
?>