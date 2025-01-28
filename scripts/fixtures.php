<?php
/**
* @var PDO $pdo
 */
require "./Index.php";
require './includes/database.php';
require  './vendor/autoload.php';

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

$pdo->exec('TRUNCATE TABLE users');
$pdo->exec('TRUNCATE TABLE `groups`');
$pdo->exec('TRUNCATE TABLE answers');
$pdo->exec('TRUNCATE TABLE questions');
$pdo->exec('TRUNCATE TABLE quizz');

$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


$faker = Faker\Factory::create('fr_FR');

$multi = 0;

echo "création des groupes d'utilisateur".PHP_EOL;

for ($i = 1; $i <= 2; $i++) {
    if ($i == 2) {$group = "admin";} else {$group = "user";}
    $query = "INSERT INTO `groups` (`group`) VALUES (:group)";
    
    $prep = $pdo->prepare($query);
    $prep->bindValue(':group', $group);
    
    try
    {
        $prep->execute();
    } catch (PDOException $e)
    {
        echo "erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();
}

echo "creation admin".PHP_EOL;

for ($i = 1; $i <= 2; $i++){
    if ($i == 1) {$user = "admin"; $password = "admin"; $group = "2";} else {$user = "user1"; $password = "user1"; $group = "1";}
    $query="INSERT INTO users (username, password, group_id, enabled) VALUES 
            (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);

    $enabled = "1";
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $user);
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $group);
    $prep->bindValue(':enabled', $enabled);

    try
        {
            $prep->execute();
        } catch (PDOException $e)
        {
            echo "erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
}

echo "creation 11 users".PHP_EOL;

for ($i = 0; $i <= 10; $i++){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="INSERT INTO users (username, password, group_id, enabled) VALUES 
            (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);

    $number = 1;
    $password = $faker->word();
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $faker->FirstName());
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $number, PDO::PARAM_INT);
    $prep->bindValue(':enabled', $faker->numberBetween(0, 1));

    try
    {
        $prep->execute();

    }
    catch (PDOException $e)
    {
        echo " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();
}

echo "creation quizz lié aléatoirement à des users".PHP_EOL;

for ($i = 0; $i < 50; $i++) {
    $user = $faker->numberBetween(1,11);
    $query="INSERT INTO `quizz` (title, published, user_id)  VALUES 
            (:title, :published, :user_id)";

    $prep = $pdo->prepare($query);
    $prep->bindValue(':title', $faker->words(2, true));
    $prep->bindValue(':published', $faker->numberBetween(0,1));
    $prep->bindValue(':user_id', $user);

    try
    {
        $prep->execute();
        $quizz_id = $pdo->lastInsertId();
    }
    catch (PDOException $e)
    {
        echo " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();

    echo "création des question lié au quizz".PHP_EOL;
    for ($y = 0; $y < $faker->numberBetween(3,8); $y++) {
        $multi = $faker->numberBetween(0,1);
        $questions = "INSERT INTO `questions` (question, multi, quizz_id) VALUES (:question, :multi, :quizz_id)";

        $prepare = $pdo->prepare($questions);
        $prepare->bindValue(':question', $faker->sentence());
        $prepare->bindValue(':multi', $multi);
        $prepare->bindValue(':quizz_id', $quizz_id);

        try
        {
            $prepare->execute();
            $question_id = $pdo->lastInsertId();
        } catch (PDOException $e)
        {
            echo "erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prepare->closeCursor();

        echo "création des réponses liés au questions".PHP_EOL;
        $nbAnswers = $faker->numberBetween(2, 10);
        $nbCorrectAnswers = 0;

        for ($x = 0; $x < $nbAnswers; $x++) {
            
            if ($multi === 1) {
                if ($nbCorrectAnswers < 2) {
                    $correct = 1;
                    $nbCorrectAnswers++;
                } else {
                    $correct = $faker->numberBetween(0, 1);
                    if ($correct === 1) {
                        $nbCorrectAnswers++;
                    }
                }
            } else {
                $correct = ($x === 0) ? 1 : 0;
            }

            $answers = "INSERT INTO `answers` (`text`, correct, points, question_id) VALUES (:text, :correct, :points, :question_id)";

            $prep = $pdo->prepare($answers);
            $prep->bindValue(':text', $faker->sentence());
            $prep->bindValue(':correct', $correct, PDO::PARAM_BOOL);
            if ($correct === 0)
            {
                $prep->bindValue(':points', 0, PDO::PARAM_INT);
            } else {
                $prep->bindValue(':points', $faker->numberBetween(1,5), PDO::PARAM_INT);
            }
            $prep->bindValue(':question_id', $question_id, PDO::PARAM_INT);

            try
            {
                $prep->execute();
            } catch (PDOException $e)
            {
                echo "erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
            }
            $prep->closeCursor();
        }
    }
}

?>
