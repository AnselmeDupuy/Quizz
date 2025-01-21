<?php 

require "./Model/editQuizz.php";

const LIST_QUIZZ_ITEMS_PER_PAGE = 5;


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
){
    $page = cleanString($_GET['page']) ?? 1;
    [$persons, $count] = getQuizz($pdo, LIST_QUIZZ_ITEMS_PER_PAGE, $page);

    if (!is_array($persons)) {
        $errors[] = $persons;
    }
    header('Content-Type: application/json');
    echo json_encode(['results' => $persons, 'count' => $count]);
    exit();
} else {
    echo "erreur Controller editQuizz";
}


require "./View/editQuizz.php";

?> 