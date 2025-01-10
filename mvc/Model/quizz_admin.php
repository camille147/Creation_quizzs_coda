<?php
function getQuizzAdmin(PDO $pdo, int $id): array | string
{
   
        $query = "
            SELECT 
                q.id AS quiz_id,
                q.title AS quiz_title,
                q.published AS quiz_published,
                question.id AS question_id,
                question.title AS question_title,
                question.type AS question_type
            FROM 
                quizz AS q
            LEFT JOIN 
                question ON q.id = question.quizz_id
            WHERE 
                q.id = :id
        ";
    
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (empty($results)) {
            return [];
        }
    
        // Structurer les données
        $quiz = [
            'id' => $results[0]['quiz_id'],
            'title' => $results[0]['quiz_title'],
            'published' => $results[0]['quiz_published'],
            'questions' => []
        ];
    
        foreach ($results as $row) {
            if (!empty($row['question_id'])) {
                $quiz['questions'][] = [
                    'id' => $row['question_id'],
                    'title' => $row['question_title'],
                    'type' => $row['question_type']
                ];
            }
        }
    
        return $quiz;
    }
    


function updateQuizz(
    PDO $pdo,
    int $id,
    string $title,
    bool $published,
): bool | string
{

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE quizz SET title = :title, published = :published WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->bindValue(':title', $title);
    $prep->bindValue(':published', $published, PDO::PARAM_BOOL);
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