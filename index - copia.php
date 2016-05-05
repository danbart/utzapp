<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->config(array(
		'debug' => true,
		'templates.path' => 'views',
	));

$app->get('/',function(){
	echo 'Hola';
});

$app->map('/home/:nombre',function($nombre) use($app){
	$app->render('templates.php', array('nombre'=>$nombre));
})->via('GET', 'POST')->conditions(array('nombre'=>'[a-zA-Z]{3,}'))->name('inicio');

$app->get('/llamada', function() use($app){
	$url = $app->urlFor('inicio', array('nombre'=>'alonso'));
	echo '<a href="'.$url.'">Ir a Home</a>';
});



$app->run();