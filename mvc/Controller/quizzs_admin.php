<?php
    require "Model/quizzs_admin.php";

    const LIST_PERSONS_ITEMS_PER_PAGE = 2;

    $action = '';
    $errors = [];
    if (!empty($_GET['id'])) {
        //$action = 'edit';
        $action = $_GET['action'];
        if ($action == 'delete') {
                deleteQuizz($pdo, $_GET['id']);
                $errors[]= "suppression reussi";
                echo("suppression ok");
                header("Location: index.php?component=quizzs_admin");
        }else {
            $errors[]= "sup pas reussi";
            var_dump($action);
        }

        
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $page = cleanString($_GET['page']) ?? 1;    
        [$quizzsAdmin, $countAdmin] = getQuizzsAdmin($pdo, $page, LIST_PERSONS_ITEMS_PER_PAGE);

        if(!is_array($quizzsAdmin)){
            $errors[] = $quizzsAdmin;
        }
        
        header("Content-Type: application/json");
        echo json_encode(['results' => $quizzsAdmin, 'count' => $countAdmin]);    
        
        exit();
    
    }
    require "View/quizzs_admin.php";
?>
    