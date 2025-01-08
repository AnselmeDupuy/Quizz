<?php 

require "./Model/login.php";


$username = !empty($_POST['username']) ? $_POST['username'] : null;
$password = !empty($_POST['password']) ? $_POST['password'] : null;

if($username !== null && $password !== null){
    $username = cleanString($username);
    $password = cleanString($password);

    $user = getUser($username, $pdo);
    if(is_array($user)){
        $isMatchPassword = is_array($user) && password_verify($password, $user['password']); 

        if($isMatchPassword ){
            $_SESSION['auth'] = true;
            header('Location: index.php');
        } else {
            var_dump("invalid connexion");
        }
    } else {
        var_dump("Utilisateur invalide");
    }
}

require "./View/login.php";
?>