<?php 

function getQuizzes(PDO $pdo)
{
    try {
        $state = $pdo->prepare("SELECT * FROM quizz");
    } catch {

    }
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

function getQuestionId(PDO $pdo, int $questionId)
{
    try {
    $state = $pdo->prepare("SELECT * FROM question WHERE id = ':questionId'");
    $state->bindValue(':quizzId', $questionId);
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