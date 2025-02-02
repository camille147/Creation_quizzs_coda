<?php
    require "Model/quizzs.php";

    const LIST_PERSONS_ITEMS_PER_PAGE = 15;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $page = cleanString($_GET['page']) ?? 1;    
        [$quizzs, $count] = getQuizzs($pdo, $page, LIST_PERSONS_ITEMS_PER_PAGE);

        if(!is_array($quizzs)){
            $errors[] = $quizzs;
        }
        
        header("Content-Type: application/json");
        echo json_encode(['results' => $quizzs, 'count' => $count]);    
        
        exit();
    
    }
    require "View/quizzs.php";
?>
