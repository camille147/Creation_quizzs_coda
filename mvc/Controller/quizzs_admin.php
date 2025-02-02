<?php
    require "Model/quizzs_admin.php";

    const LIST_PERSONS_ITEMS_PER_PAGE = 15;

    $action = $_GET['action'] ?? '';
    $errors = [];

    if (!empty($_GET['id']) && ($_GET['action'])==='delete') {
        $id = cleanString($_GET['id']);

        $action = $_GET['action'];
        if ($action === 'delete') {
                deleteQuizz($pdo, $id);
                $errors[]= "suppression reussi";
                echo("suppression ok");
                header("Location: index.php?component=quizzs_admin");
                exit();
        }else {
            $errors[]= "Echec de la suppression";
            var_dump($action);
        }

        
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        switch ($action) {
            case '':
                $page = cleanString($_GET['page']) ?? 1;    
                [$quizzsAdmin, $countAdmin] = getQuizzsAdmin($pdo, $page, LIST_PERSONS_ITEMS_PER_PAGE);

                if(!is_array($quizzsAdmin)){
                    $errors[] = $quizzsAdmin;
                }
                
                header("Content-Type: application/json");
                echo json_encode(['results' => $quizzsAdmin, 'count' => $countAdmin]);    
                
                exit();

            case 'toggle_enabled':
                $id = cleanString($_GET['id']);
                $res = toggleEnabled($pdo, $id);
                header("Content-Type: application/json");
                if (is_bool($res)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => $res]);
                }
                exit();
            }
    
    }
    require "View/quizzs_admin.php";
?>
    