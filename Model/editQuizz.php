<?php 

function getQuizz(PDO $pdo,int $itemPerPage, int $page = 1): array | string
{
    $offset = (($page - 1) * $itemPerPage);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM quizz LIMIT $itemPerPage OFFSET $offset";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur 1 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $quizzes = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    $query="SELECT COUNT(*) AS total  FROM quizz";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur 2 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return [$quizzes, $count];
}

function getQuestion(PDO $pdo, int $quizzId)
{
    try {
    $state = $pdo->prepare("SELECT * FROM `questions` WHERE quizz_id = :quizzId");
    $state->bindValue(':quizzId', $quizzId);
    $state->execute();

    $questions = $state->fetchAll(PDO::FETCH_ASSOC);
    $state->closeCursor();

    } catch (Exception $e) {
        return $e->getMessage();
    }

    $query="SELECT COUNT(*) AS total FROM `questions` WHERE quizz_id = :quizzId";
    $state = $pdo->prepare($query);
    $state->bindValue(':quizzId', $quizzId);

    try
    {
        $state->execute();
    }
    catch (PDOException $e)
    {
        return " erreur 2 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $state->fetch();
    $state->closeCursor();

    return [$questions, $count];
}

function getAnswer(PDO $pdo, int $questionId)
{
    try {
    $state = $pdo->prepare("SELECT * FROM answers WHERE id = :questionId");
    $state->bindValue(':questionId', $questionId);
    $state->execute();

    $answers = $state->fetchAll(PDO::FETCH_ASSOC);
    $state->closeCursor();

    return $answers;

    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function updateQuizz(PDO $pdo, int $quizzId, string $title, bool $published)
{
    try {
        $state = $pdo->prepare("UPDATE `quizz` SET title = :title, published = :published WHERE id = :id");
        $state->bindValue(':title', $title);
        $state->bindValue(':published', $published, PDO::PARAM_INT);
        $state->bindValue(':id', $quizzId);

        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    } 
}

function updateQuestion(PDO $pdo, string $question,int $multi, int $questionId) 
{

    try {
        $state= $pdo->prepare("UPDATE `questions` SET question = :question, multi = :multi WHERE id = :questionId");
        $state->bindValue(':question', $question);
        $state->bindValue(":multiple", $multi, PDO::PARAM_BOOL);
        $state->bindValue(':questionId', $questionId, PDO::PARAM_INT);

        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function updateAnswers(PDO $pdo, string $answer, int $isCorrect, int $points, int $answerId) 
{
    try {
    $state = $pdo->prepare("UPDATE `answers` SET text = :text, correct = :correct, points = :points WHERE id = :answerId");

    $state->bindValue(':text', $answer);
    $state->bindValue(':correct', $isCorrect, PDO::PARAM_BOOL);
    $state->bindValue(':points', $points, PDO::PARAM_INT);
    $state->bindValue(':answerId', $answerId, PDO::PARAM_INT);

    $state->execute();
    } catch (Exception $e)
    {
        return $e->getMessage();
    }
}

?>