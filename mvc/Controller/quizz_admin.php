<?php
    require "Model/quizz_admin.php";

    $action = 'create';
    $errors = [];
    if (!empty($_GET['id'])) {
        //$action = 'edit';
        $action = $_GET['action'];
        if ($action == 'edit') {
            $quizz = getQuizzAdmin($pdo, $_GET['id']);
            if(!is_array($quizz)) {
                $errors = $quizz;
            }
        }else {
            var_dump($action);
        }

        
    }

    if (isset($_POST['edit_button'])) {
        $id = cleanString($_GET['id']);
        $title = !empty($_POST['title']) ? cleanString($_POST['title']) : null;
        $published = !empty($_POST['published']) ? cleanString($_POST['published']) : false;
        
        if(empty($errors)) {

            $updatedQuizz = updateQuizz($pdo, $id,$title,$published);
            //console.log($updatedQuizz);

            if (!is_bool($updatedQuizz)) {
                $errors[] = $updatedQuizz;
            } else {
                $quizz = getQuizzAdmin($pdo, $_GET['id']);

                header("Location: index.php?component=quizzs_admin");
                exit();
            }
        }
    }
    require "View/quizz_admin.php";
?>