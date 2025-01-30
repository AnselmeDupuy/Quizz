<?php 

require "./Model/editQuizz.php";

const LIST_QUIZZ_ITEMS_PER_PAGE = 5;


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){
    if (isset($_GET['page'])){
        $page = cleanString($_GET['page']) ?? 1;
        [$quizz, $count] = getQuizz($pdo, LIST_QUIZZ_ITEMS_PER_PAGE, $page);

        if (!is_array($quizz)) {
            $errors[] = $quizz;
        }
        header('Content-Type: application/json');
        echo json_encode(['results' => $quizz, 'count' => $count]);
        exit();
    }

    if (!empty($_GET['object'] === 'question')) {

        if (!empty($_GET['quizz-id'])) {
            $quizzId = getQuestion($pdo,cleanString((int)$_GET['quizz-id']));
            
            header('Content-Type: application/json');
            echo json_encode(['quizzId' => $quizzId]);
            exit();
        }
    }

    if (!empty($_GET['object']) && (cleanString($_GET['object']) === 'answer')) {

        if (!empty($_GET['question-id'])) {
            $questionId = getAnswer($pdo,cleanString((int)$_GET['question-id']));
            
            header('Content-Type: application/json');
            echo json_encode(['question-id' => $questionId]);
            exit();
        }
    }


} 

require "./View/editQuizz.php";

 