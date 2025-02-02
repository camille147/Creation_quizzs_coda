<?php
function getQuestionAdmin(PDO $pdo, int $id): array | string
{
   
        $query = "
            SELECT 
                question.id AS quest_id, 
                question.title AS quest_title, 
                question.published AS quest_published,
                question.type AS quest_type,
                question.Numero_question AS quest_num_quest,
                question.quizz_id AS quizz_id,


                response.id AS res_id,
                response.title AS res_title,
                response.statut AS res_statut,
                response.points AS res_points,
                response.question_id AS res_ques_id

            FROM 
                question 
            LEFT JOIN 
                response ON question.id = response.question_id
            WHERE 
                question.id = :id
        ";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (empty($results)) {
            return [];
        }
    
        $question = [
            'id' => $results[0]['quest_id'],
            'title' => $results[0]['quest_title'],
            'published' => $results[0]['quest_published'],
            'type' => $results[0]['quest_type'],
            'Numero_question' => $results[0]['quest_num_quest'],
            'quizz_id' => $results[0]['quizz_id'],
            'responses' => []
        ];
    
        foreach ($results as $row) {
            if (!empty($row['res_id'])) {
                $question['responses'][] = [
                    'id' => $row['res_id'],
                    'title' => $row['res_title'],
                    'statut' => $row['res_statut'],
                    'points' => $row['res_points'],
                    'question_id' => $row['res_ques_id']
                ];
            }
        }

    
        return $question;
}

    function updateQuestion(
        PDO $pdo,
        int $id,
        string $title,
        bool $published,
        bool $type,
        int $Numero_question
    ): bool | string
    {
    
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="UPDATE question SET title = :title, type = :type, Numero_question = :Numero_question, published = :published WHERE id = :id";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        $prep->bindValue(':title', $title);
        $prep->bindValue(':published', $published, PDO::PARAM_BOOL);
        $prep->bindValue(':type', $type, PDO::PARAM_BOOL);
        $prep->bindValue(':Numero_question', $Numero_question, PDO::PARAM_INT);

        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
    
    
        return true;
}

function updateResponses(
    PDO $pdo,
    int $question_id,
    array $responses
): bool | string
{

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($responses as $response) {
        $query="UPDATE response SET title = :title, statut = :statut, points = :points WHERE id = :id AND question_id = :question_id";
        $prep = $pdo->prepare($query);
        
        $prep->bindValue(':title', $response['title']);
        $prep->bindValue(':statut', $response['statut'], PDO::PARAM_BOOL);
        $prep->bindValue(':points', $response['points'], PDO::PARAM_INT);
        $prep->bindValue(':id', $response['id'], PDO::PARAM_INT);
        $prep->bindValue(':question_id', $question_id, PDO::PARAM_INT);

        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
    }


    return true;
}

function deleteResponse(
    PDO $pdo,
    int $id,
    
)
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="DELETE FROM response WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();


    return true;
}

function insertResponse(PDO $pdo, int $question_id, string $title, int $isCorrect, int $points): bool {
    try {
        $query = "INSERT INTO responses (question_id, title, statut, points) VALUES (:question_id, :title, :statut, :points)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([
            ':question_id' => $question_id,
            ':title' => trim($title),
            ':statut' => $isCorrect,
            ':points' => $points
        ]);
    } catch (PDOException $e) {
        error_log("Erreur lors de l'insertion : " . $e->getMessage());
        return false;
    }
}