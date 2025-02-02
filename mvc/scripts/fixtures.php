<?php
/**
* @var PDO $pdo
*/
require '../Includes/database.php';
require __DIR__ . '/../vendor/autoload.php';  
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../mvc');
$dotenv = Dotenv::createImmutable(__DIR__ . '/../.env');  
$dotenv->load();


$faker = Faker\Factory::create('fr_FR');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for ($i = 0; $i <= 50; $i++) {
    $query = "INSERT INTO quizz (title, published, number_question) VALUES 
              (:title, :published, :number_question)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':title', $faker->lastName());
    $prep->bindValue(':published', $faker->numberBetween(1, 2), PDO::PARAM_INT);
    $prep->bindValue(':number_question', $faker->numberBetween(1, 10), PDO::PARAM_INT);

    try {
        $prep->execute();
        $quizzId = $pdo->lastInsertId();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getCode() . ' : ' . $e->getMessage();
    }
    $prep->closeCursor();

    for ($j = 0; $j < 5; $j++) {
        $query = "INSERT INTO question (title, type, quizz_id, Numero_question, published) VALUES 
                  (:title, :type, :quizz_id, :Numero_question, :published)";
        $prep = $pdo->prepare($query);
        $type = $faker->numberBetween(0, 1);
        $prep->bindValue(':title', $faker->sentence());
        $prep->bindValue(':type', $type, PDO::PARAM_INT);
        $prep->bindValue(':quizz_id', $quizzId, PDO::PARAM_INT);
        $prep->bindValue(':Numero_question', $j + 1, PDO::PARAM_INT);
        $prep->bindValue(':published', $faker->numberBetween(0, 1), PDO::PARAM_INT);

        try {
            $prep->execute();
            $questionId = $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getCode() . ' : ' . $e->getMessage();
        }
        $prep->closeCursor();

        for ($k = 0; $k < 4; $k++) {
            $query = "INSERT INTO response (title, statut, points, question_id) VALUES 
                      (:title, :statut, :points, :question_id)";
            $prep = $pdo->prepare($query);
            $statut = ($type == 0) ? $faker->numberBetween(0, 1) : $k == 0; 
            $prep->bindValue(':title', $faker->sentence());
            $prep->bindValue(':statut', $statut, PDO::PARAM_INT);
            $prep->bindValue(':points', $statut ? 10 : 0, PDO::PARAM_INT); 
            $prep->bindValue(':question_id', $questionId, PDO::PARAM_INT);

            try {
                $prep->execute();
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getCode() . ' : ' . $e->getMessage();
            }
            $prep->closeCursor();
        }
    }
}
?>