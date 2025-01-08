<?php

function createQuizz(PDO $pdo, string $title, int $userId)
{
    try {
        $state = $pdo->prepare("INSERT INTO `quizz` (`title`, `user_id`) 
        VALUES (:title, :user_id)");
        $state->bindValue(':title', $title);
        $state->bindValue(':user_id', $userId);

        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


?>