<?php 

session_start();


require  './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require "Includes/database.php";
require "Includes/function.php";


if(isset($_GET["disconnect"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
if(!empty($_SESSION['auth'])) {
    $component = !empty($_GET['component'])
        ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
        : 'home';

    $actionName = !empty($_GET['ajax'])
        ? htmlspecialchars($_GET['ajax'], ENT_QUOTES, 'UTF-8')
        : null;

    if (file_exists("controller/$component.php")) {
        require "controller/$component.php";
    } else {
        throw new Exception("Component '$component' does not exist");
    }
} else {
    require "controller/login.php";
}
exit();
}


?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Quizz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>

        <div class="container">

        <?php




        if(isset($_SESSION['auth'])){
            require "_partials/navbar.php";
            if(isset($_GET['component'])) {
                $component = !empty($_GET['component'])
                    ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
                    : 'home';
                
                $actionName = !empty($_GET['ajax'])
                    ? htmlspecialchars($_GET['ajax'], ENT_QUOTES, 'UTF-8')
                    : null;

                if(file_exists("Controller/$component.php"))
                { 
                    require "Controller/$component.php";
                } else {
                    require "Controller/home.php";
                }
            } 
        } else {
            require "Controller/login.php";
        }

        ?>

            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>


</html>
