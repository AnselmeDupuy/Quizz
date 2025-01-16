<?php 

/**
* @var PDO $pdo
 */

require "./Model/login.php";


if (!empty($_POST['username']) && !empty($_POST['password'])){
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    if($username !== null && $password !== null){
        $username = cleanString($username);
        $password = cleanString($password);

        $user = getUser($username, $pdo);
        var_dump($user);
        if(is_array($user)){
            $isMatchPassword = is_array($user) && password_verify($password, $user['password']); 

            if($isMatchPassword && $user['enabled']){
                $_SESSION['auth'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] = $user['id'];
                header('Location: ?component=quizz');
                exit();
            } else {
                var_dump("invalid connexion");
            }
        } else {
            var_dump("Utilisateur invalide");
        }
    }
}

require "./View/login.php";

?>