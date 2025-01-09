<?php

function createQuizz(PDO $pdo, string $title, int $userId)
{
    try {
        $state = $pdo->prepare("INSERT INTO `quizz` (`title`, `user_id`) 
        VALUES (:title, :user_id)");
        $state->bindValue(':title', $title);
        $state->bindValue(':user_id', $userId, PDO::PARAM_INT);

        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getQuizzId(PDO $pdo, int $quizzId)
{
    try {
    $state = $pdo->prepare("SELECT id FROM quizz WHERE id = ':quizzId'");
    $state->bindValue(':quizzId', $quizzId);
    $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }

}

function addQuestion(PDO $pdo, string $label, string $question,int $multi, int $quizzId) 
{

    try {
        $state= $pdo->prepare("INSERT INTO `questions` (`question`,`multiple`, `quizz_id`)
        VALUES (:question, :multiple, :quizz_id)");
        $state->bindValue(':question', $question);
        $state->bindValue(":multiple", $multi, PDO::PARAM_BOOL);
        $state->bindValue(':quizz_id', $quizzId, PDO::PARAM_INT);

        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
    
}

function getQuestionId(PDO $pdo, int $questionId)
{
    try {
    $state = $pdo->prepare("SELECT id FROM question WHERE id = ':questionId'");
    $state->bindValue(':quizzId', $questionId);
    $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }

}



function addAnswers(PDO $pdo, array $answer) 
{
    $state = $pdo->prepare("INSERT INTO `answer` ()");

}


?>