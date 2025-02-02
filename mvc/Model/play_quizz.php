<?php
function getPlayQuizz(PDO $pdo, int $id): array
{
    $query = "
        SELECT 
            question.id AS quest_id, 
            question.title AS quest_title, 
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
            question.quizz_id = :id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) {
        return []; 
    }

    $questions = [];
    
    foreach ($results as $row) {
        $quest_id = $row['quest_id'];

        if (!isset($questions[$quest_id])) {
            $questions[$quest_id] = [
                'id' => $row['quest_id'],
                'title' => $row['quest_title'],
                'type' => $row['quest_type'],
                'Numero_question' => $row['quest_num_quest'],
                'quizz_id' => $row['quizz_id'],
                'responses' => []
            ];
        }

        if (!is_null($row['res_id'])) {
            $questions[$quest_id]['responses'][] = [
                'id' => $row['res_id'],
                'title' => $row['res_title'],
                'statut' => $row['res_statut'],
                'points' => $row['res_points'],
                'question_id' => $row['res_ques_id']
            ];
        }
    }

    return array_values($questions);
}
