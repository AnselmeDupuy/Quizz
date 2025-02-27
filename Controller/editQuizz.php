<?php 

require "./Model/editQuizz.php";
require "./Model/listQuizz.php";


if (!empty($_GET['id'])) {
    $quizzId = cleanString((int)$_GET['id']);
    $quizz = loadQuizzData($pdo, $quizzId);
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quizz'])) {
    $quizzId = cleanString((int)$_GET['id']);
    $quizz = $_POST['quizz'];
    $title = cleanString($quizz['title']);
    $published = isset($quizz['published']) ? 1 : 0;
    $questions = $_POST['questions'];
    updateQuizz($pdo, $quizzId, $title, $published);

    foreach ($questions as $question) {
        $questionId = $question['id'];
        $questionText = $question['question'];
        $multi = isset($question['multi']) ? 1 : 0;
        updateQuestion($pdo, $questionText, $multi, $questionId);

        foreach ($question['answers'] as $answer) {
            $answerId = $answer['id'];
            $answerText = $answer['text'];
            $points = (int)$answer['points'];
            $isCorrect = isset($answer['correct']) ? 1 : 0;
            updateAnswer($pdo, $answerText, $isCorrect, $points, $answerId);
        }
    }

    $quizz = loadQuizzData($pdo, $quizzId);
}

require "./View/editQuizz.php";