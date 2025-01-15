<?php 

require "./Model/editQuizz.php";

$userId = $_GET['id'];


if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    $page = cleanString($_GET['page']) ?? 1;
    $userId = getQuizzId($pdo, $userId);
    if(is_array($userId)){
        $errors[] = $userId;
    }
    header('Content-type: application/json');
    echo json_encode(['results' => $userId, 'count' => $a]);
    exit();
}



require "./View/editQuizz.php";
?>