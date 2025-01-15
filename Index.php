<?php 

session_start();


require  './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
var_dump($_ENV);
require "Includes/database.php";
require "Includes/function.php";


if(isset($_GET["disconnect"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}



?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Quizz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>

        <div class="container">

        <?php

        if(isset($_SESSION['auth'])){
            require "_partials/navbar.php";
            if(isset($_GET['component'])) {
                $component = cleanString($_GET['component']);
                if(file_exists("Controller/$component.php"))
                { 
                    require "Controller/$component.php";
                } else {
                    require "Controller/login.php";
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