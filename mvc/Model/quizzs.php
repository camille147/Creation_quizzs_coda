<?php

//function getAll(PDO $pdo) {
//    $res = $pdo->prepare('SELECT * FROM quizz LIMIT 2');
//    $res->execute();
//    return $res->fetchAll();

//}
function getQuizzs(int $page = 1, int $itemPerPage): array | string
{
    
    $offset = ($page - 1) * $itemPerPage;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT * FROM quizz  LIMIT $itemPerPage OFFSET $offset";
    $prep = $pdo->prepare($query);
    try
    {
        
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $quizzs = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();


    
   

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT COUNT(*) AS total  FROM quizz ";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return [$quizzs, $count];



    

    
}


?>