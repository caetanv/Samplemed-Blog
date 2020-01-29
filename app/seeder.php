<?php
/**
 * Populate MySQL Table Using faker
 * 
 * @author muni <muni@smarttutorials.net>
 */
require_once('./vendor/autoload.php');
try{
    $count = 10;

    //Connecting MySQL Database
    $pdo  = new PDO('mysql:host=127.0.0.1;dbname=samplemedblog', 'root', '123456', array(
        PDO::ATTR_PERSISTENT => true
    ));
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


    $seeder = new \tebazil\dbseeder\Seeder($pdo);
    $generator = $seeder->getGeneratorConfigurator();
    $faker = $generator->getFakerConfigurator();

    $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=0");
    $stmt->execute();


    $seeder->table('topics')->columns([
        'id', //automatic pk
        'title'=>$faker->text(45),
        'visible'=>$faker->randomElement([0,1])

            ])->rowQuantity($count);


    $seeder->table('posts')->columns([
        'id',
        'body'=>$faker->text(200)
    ])->rowQuantity($count);

    $seeder->table('users')->columns([
        'id',
        'username'=>$faker->firstName,
        'password'=>$faker->firstName,
        'full_name'=>$faker->firstName,
        'role'=>$faker->randomElement([0,1])
    ])->rowQuantity($count);


    $seeder->refill();

    $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
    $stmt->execute();

} catch(Exception $e){
    echo '<pre>';print_r($e);echo '</pre>';
}
