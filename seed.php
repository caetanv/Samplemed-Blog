<?php
try{
	require_once('./vendors/autoload.php');
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=samplemedblog', 'root', '123456');
	$seeder = new \tebazil\dbseeder\Seeder($pdo);
	$generator = $seeder->getGeneratorConfigurator();
	$faker = $generator->getFakerConfigurator();


	$stmt = $pdo->prepare('set foreign_key_checks=0');
	$stmt->execute();

	$seeder->table('topics')->columns([
	    'id', //automatic pk
	    'user_id', //automatic fk
	    'title'=>$faker->firstName,
	    'visible'=>$faker->randomElement([0,1])
	        ])->rowQuantity(30);


	$seeder->table('posts')->columns([
	    'id',
	    'topic_id',
	    'user_id',
	    'body'=>$faker->text(200),
	])->rowQuantity(30);

	$seeder->table('users')->columns([
	    'id',
	    'username'=>$faker->firstName,
	    'password'=>$faker->firstName,
	    'full_name'=>$faker->firstName,
	    'role'=>$faker->randomElement([0,1])
	])->rowQuantity(30);

	$seeder->refill();



	$stmt = $pdo->prepare('set foreign_key_checks=1');
	$stmt->execute();

	}catch(Exception $e){
		echo $e;
	}
?>