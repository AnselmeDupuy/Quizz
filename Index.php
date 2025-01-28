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
    $componentName = !empty($_GET['component'])
        ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
        : 'home';

    $objectName = !empty($_GET['object']) ? htmlspecialchars($_GET['object'], ENT_QUOTES, 'UTF-8') : 'home';
        
    if (file_exists("controller/$componentName.php")) {
        require "controller/$componentName.php";
    } else {
        throw new Exception("Component '$componentName' does not exist");
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
        <link href="includes/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="includes/fontawesome-free-6.7.1-web/css/all.min.css" />
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
            <script src="includes/js/bootstrap.bundle.min.js"></script>
        </body>


</html>
