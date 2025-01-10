<?php
function getQuizzsAdmin(PDO $pdo, int $page = 1, int $itemsPerPage): array
{
    $offset = ($page - 1) * $itemsPerPage;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $query = "SELECT id, title, published FROM quizz LIMIT :limit OFFSET :offset";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $prep->bindValue(':offset', $offset, PDO::PARAM_INT);
        $prep->execute();

        $quizzs = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        $countQuery = "SELECT COUNT(*) AS total FROM quizz";
        $countprep = $pdo->prepare($countQuery);
        $countprep->execute();
        $count = $countprep->fetch(PDO::FETCH_ASSOC);
        $countprep->closeCursor();


        return [$quizzs, $count];


    } catch (PDOException $e) {
        return [
            'error' => 'Erreur : ' . $e->getMessage()
        ];
    }
}

?>
