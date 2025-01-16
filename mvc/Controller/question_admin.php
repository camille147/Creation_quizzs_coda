<?php
    require "Model/question_admin.php";

    $action = 'create';
    $errors = [];
    if (!empty($_GET['id'])) {
        //$action = 'edit';
        $action = $_GET['action'];
        if ($action == 'edit_question') {
            $question = getQuestionAdmin($pdo, $_GET['id']);
            //var_dump($question);
            if(!is_array($question)) {
                $errors = $question;
            }
        }else {
            //var_dump($action);
        }
    }
    
    if (isset($_POST['edit_question_button'])) {
        $id = cleanString($_GET['id']);
        $title = !empty($_POST['title']) ? cleanString($_POST['title']) : null;
        $published = !empty($_POST['published']) ? cleanString($_POST['published']) : false;
        $type = !empty($_POST['type']) ? cleanString($_POST['type']) : false;
        $Numero_question = !empty($_POST['num_quest']) ? cleanString($_POST['num_quest']) : null;
        
        if(empty($errors)) {

            $updatedQuestion = updateQuestion($pdo, $id,$title,$published,$type,$Numero_question);
            //console.log($updatedQuestion);

            if (!is_bool($updatedQuestion)) {
                $errors[] = $updatedQuestion;
            } else {
                $question = getQuestionAdmin($pdo, $_GET['id']);

                header("Location: index.php?component=quizzs_admin");
                exit();
            }
        }
    }
    
    require "View/question_admin.php";
    ?>