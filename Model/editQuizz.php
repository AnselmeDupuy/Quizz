<?php 

function getQuizzById(PDO $pdo, int $quizzId): array | string
{
    try {
        $state = $pdo->prepare("SELECT * FROM `quizz` WHERE id = :id");
        $state->bindValue(':id', $quizzId);
        $state->execute();

        $quizz = $state->fetch(PDO::FETCH_ASSOC);
        $state->closeCursor();
    } catch (Exception $e) {
        return $e->getMessage();
    }

    return $quizz;
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

function updateAnswer(PDO $pdo, string $answer, int $isCorrect, int $points, int $answerId) 
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

function loadQuizzData($pdo, $quizzId) {
    $quizz = getQuizzById($pdo, $quizzId);
    $questionsArray = getQuestion($pdo, $quizzId);
    $questions = $questionsArray[0];
    foreach ($questions as &$question) {
        $questionAnwserArray = getAnswer($pdo, $question['id']);
        $question['answers'] = $questionAnwserArray[0];
    }
    $quizz['questions'] = $questions;
    return $quizz;
}


?>




