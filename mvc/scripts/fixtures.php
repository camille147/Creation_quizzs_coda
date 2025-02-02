<?php
/**
* @var PDO $pdo
*/
require '../Includes/database.php';
require './vendor/autoload.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
//$dotenv->load(); // Charge les variables d'environnement avant de les utiliser

// Maintenant vous pouvez accéder aux variables d'environnement
//var_dump($_ENV['DB_NAME']);   // Affiche la valeur de DB_NAME
//echo $_ENV['DB_NAME'];   

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$faker = Faker\Factory::create('fr_FR');

for ($i = 0; $i <= 50; $i++) {
    $query = "INSERT INTO quizz (title, published, number_question) VALUES 
              (:title, :published, :number_question)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':title', $faker->lastName());
    $prep->bindValue(':published', $faker->numberBetween(1, 2), PDO::PARAM_INT);
    $prep->bindValue(':number_question', $faker->numberBetween(1, 10), PDO::PARAM_INT);

    try {
        $prep->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getCode() . ' : ' . $e->getMessage();
    }
    $prep->closeCursor();
}
?>