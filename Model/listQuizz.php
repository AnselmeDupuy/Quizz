<?php 

function getQuizz(PDO $pdo, int $itemPerPage, int $page = 1): array | string
{
    $offset = (($page - 1) * $itemPerPage);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM quizz LIMIT $itemPerPage OFFSET $offset";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    } catch (PDOException $e) {
        return " erreur 1 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $quizzes = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    $query = "SELECT COUNT(*) AS total FROM quizz";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    } catch (PDOException $e) {
        return " erreur 2 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return [$quizzes, $count];
}

function getQuestion(PDO $pdo, int $quizzId): array | string
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

    $query = "SELECT COUNT(*) AS total FROM `questions` WHERE quizz_id = :quizzId";
    $state = $pdo->prepare($query);
    $state->bindValue(':quizzId', $quizzId);

    try {
        $state->execute();
    } catch (PDOException $e) {
        return " erreur 1 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $state->fetch();
    $state->closeCursor();

    return [$questions, $count];
}

function getAnswer(PDO $pdo, int $questionId): array | string
{
    try {
        $state = $pdo->prepare("SELECT * FROM `answers` WHERE question_id = :questionId");
        $state->bindValue(':questionId', $questionId);
        $state->execute();

        $answers = $state->fetchAll(PDO::FETCH_ASSOC);
        $state->closeCursor();
    } catch (Exception $e) {
        return $e->getMessage();
    }

    $query = "SELECT COUNT(*) AS total FROM `answers` WHERE question_id = :questionId";
    $state = $pdo->prepare($query);
    $state->bindValue(':questionId', $questionId);

    try {
        $state->execute();
    } catch (PDOException $e) {
        return " erreur 2 : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $count = $state->fetch();
    $state->closeCursor();

    return [$answers, $count];
}
?>