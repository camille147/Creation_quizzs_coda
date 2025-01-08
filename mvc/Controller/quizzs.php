<?php
    require "Model/quizzs.php";


   // $quizzs = getAll($pdo);
    const LIST_PERSONS_ITEMS_PER_PAGE = 2;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){

        $page = cleanString($_GET['page']) ?? 1;    //ternaire encore plus court  c'est un if, si $_GET de page est pas nul alors page l'est = sinon = à 1
        [$quizzs, $count] = getQuizzs($pdo, $page, LIST_PERSONS_ITEMS_PER_PAGE);

        if(!is_array($quizzs)){
            $errors[] = $quizzs;
        }
        
            
        // Si tout va bien, envoyer les données JSON
        header("Content-Type: application/json");         // envoie une rep

        echo json_encode(['results' => $quizzs, 'count' => $count]);    
        

        exit();
    
    //console.log('hello');
    }
    require "View/quizzs.php";
?>
