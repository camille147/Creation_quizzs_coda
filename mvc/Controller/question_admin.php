<?php
    require "Model/question_admin.php";

    $action = 'create';
    $errors = [];
    if (!empty($_GET['id'])) {
        $action = $_GET['action'];

        if ($action == 'edit_question') {
            $question = getQuestionAdmin($pdo, $_GET['id']);

            if(!is_array($question)) {
                $errors = $question;
            }
        }else if ($action == 'delete') {
            if (!empty($_GET['id_quizz'])) {
                $id = cleanString($_GET['id']);
                $quizz_id = cleanString($_GET['id_quizz']);
                
                deleteResponse($pdo, $id);
                $errors[]= "suppression reussi";
                header("Location: index.php?component=question_admin&action=edit_question&id=${quizz_id}");
                exit();
            }else {
                var_dump('autre');
            }
        }
        
    }
        
    
    if (isset($_POST['edit_question_button'])) {
        $id = cleanString($_GET['id']);
        $title = !empty($_POST['title']) ? cleanString($_POST['title']) : null;
        $published = isset($_POST['published']) ? true : false;
        $type = isset($_POST['type']) ? true : false;
        $Numero_question = !empty($_POST['num_quest']) ? cleanString($_POST['num_quest']) : null;
    
        
        if (empty($errors)) {
            $responses = [];
    
            foreach ($question['responses'] as $response) {
                $responses[] = [
                    'id' => $response['id'],
                    'title' => cleanString($_POST['response_title_' . $response['id']]) ?? cleanString($response['title']),
                    'statut' => isset($_POST['statut_' . $response['id']]) ? true : false,
                    'points' => $_POST['points_' . $response['id']] ?? $response['points'],
                    'question_id' => $response['question_id'],
                ];
            }
    
            $updatedQuestion = updateQuestion($pdo, $id, $title, $published, $type, $Numero_question);
    
            $responseResult = updateResponses($pdo, $id, $responses);
    
            if (!empty($_POST['responses'])) {
                foreach ($_POST['responses'] as $key => $response) {
                    $responseTitle = trim($response['title']);
                    $isCorrect = isset($response['statut']) ? 1 : 0;
                    $points = intval($response['points']);
    
                    if (!empty($responseTitle)) {
                        insertResponse($pdo, $id, $responseTitle, $isCorrect, $points);
                    }
                }
            }
            if ($responseResult === true) {
                echo "Question et réponses mises à jour avec succès!";
            } else {
                echo "Erreur lors de la mise à jour des réponses : " . $responseResult;
            }
    
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