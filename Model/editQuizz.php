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


function getQuizzId(PDO $pdo, int $userId)
{   
    try {
    $state = $pdo->prepare("SELECT * FROM quizz WHERE user_id = ':id'");
    $state->bindValue(':id', $userId);
    $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getQuestion(PDO $pdo, int $quizzId)
{
    try {
    $state = $pdo->prepare("SELECT * FROM question WHERE id = ':questionId'");
    $state->bindValue(':quizzId', $quizzId);
    $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getAnswerId(PDO $pdo, int $answerId)
{
    try {
    $state = $pdo->prepare("SELECT * FROM answers WHERE id = ':answerId'");
    $state->bindValue(':answerId', $answerId);
    $state->execute();
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