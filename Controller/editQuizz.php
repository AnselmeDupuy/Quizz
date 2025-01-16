<?php 

require "./Model/editQuizz.php";

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
} else { 
    echo ("erreur");
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    $page = cleanString($_GET['page']) ?? 1;
    $userId = getQuizzId($pdo, $userId);
    if(is_array($userId)){
        $errors[] = $userId;
    }
    header('Content-type: application/json');
    echo json_encode(['results' => $userId]);
    exit();
}  else { echo "erreur HTTP-REQUEST edit";}

require "./View/editQuizz.php";

?> 