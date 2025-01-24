<?php 

require "./Model/editQuizz.php";

const LIST_QUIZZ_ITEMS_PER_PAGE = 5;


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){
    $page = cleanString($_GET['page']) ?? 1;
    [$quizz, $count] = getQuizz($pdo, LIST_QUIZZ_ITEMS_PER_PAGE, $page);



    if (!is_array($quizz)) {
        $errors[] = $quizz;
    }
    header('Content-Type: application/json');
    echo json_encode(['results' => $quizz, 'count' => $count]);
    exit();
} 


require "./View/editQuizz.php";

?> 