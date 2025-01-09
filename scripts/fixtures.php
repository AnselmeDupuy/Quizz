<?php
/**
* @var PDO $pdo
 */
require './includes/database.php';
require  './vendor/autoload.php';


$faker = Faker\Factory::create('fr_FR');

for ($i = 1; $i <= 2; $i++){
    if ($i == 1) {$user = "admin"; $password = "admin"; $group = "2";} else {$user = "user1"; $password = "user1"; $group = "1";}
    $query="INSERT INTO users (username, password, group_id, enabled) VALUES 
            (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);

    $enabled = "1";
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $user);
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $group);
    $prep->bindValue(':enabled', $enabled);


    $prep->execute();

}

for ($i = 0; $i <= 8; $i++){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="INSERT INTO users (username, password, group_id, enabled) VALUES 
            (:username, :password, :group_id, :enabled)";
    $prep = $pdo->prepare($query);

    $number = 1;
    $password = $faker->word();
    $password = password_hash($password, PASSWORD_DEFAULT);

    $prep->bindValue(':username', $faker->FirstName());
    $prep->bindValue(':password', $password);
    $prep->bindValue(':group_id', $number, PDO::PARAM_INT);
    $prep->bindValue(':enabled', $faker->numberBetween(0, 1));

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
?>
