<?php


function getQuizzs(PDO $pdo, int $page = 1, int $itemsPerPage): array
{
    // Calcul de l'offset pour la pagination
    $offset = ($page - 1) * $itemsPerPage;

    // Définir le mode d'erreur PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Requête pour récupérer les quizzs avec pagination
        $query = "SELECT id, title, published FROM quizz WHERE published = 1 LIMIT :limit OFFSET :offset";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $prep->bindValue(':offset', $offset, PDO::PARAM_INT);
        $prep->execute();

        // Récupérer les résultats
        $quizzs = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        // Requête pour compter le nombre total de quizzs
        $countQuery = "SELECT COUNT(*) AS total FROM quizz";
        $countprep = $pdo->prepare($countQuery);
        $countprep->execute();
        $count = $countprep->fetch(PDO::FETCH_ASSOC);

        // Retourner les résultats sous forme de tableau
        return [$quizzs, $count];


    } catch (PDOException $e) {
        // En cas d'erreur, retourner un tableau d'erreur structuré
        return [
            'error' => 'Erreur : ' . $e->getMessage()
        ];
    }
}

?>
