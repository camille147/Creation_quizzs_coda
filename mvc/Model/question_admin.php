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
                response.points AS res_points
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
                    'points' => $row['res_points']
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

    