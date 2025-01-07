<?php
/**
* @var PDO $pdo
 */
require './includes/database.php';
require  './vendor/autoload.php';


$faker = Faker\Factory::create('fr_FR');

for ($i = 0; $i <= 1; $i++){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="INSERT INTO users (username, password, group_id) VALUES 
            (:username, :password, :group_id)";
    $prep = $pdo->prepare($query);

    $number = 1;
    $password = $faker->word();
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $faker->FirstName());
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $number, PDO::PARAM_INT);

    try
    {
        $prep->execute();

    }
    catch (PDOException $e)
    {
        echo " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();
}