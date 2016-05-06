<?php
session_start();
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->config(array(
		'debug' => true,
		'templates.path' => 'views',
	));
$db= new PDO('mysql:host=localhost;dbname=utzdb','root','danilosolos');


$app->get('/',function(){
	echo 'Hola';
});

$app->get('/lenguas',function() use($app, $db){
	$dbquery = $db->prepare("SELECT * FROM utz_lengua");
	$dbquery->execute();
	$data['lenguas'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('lenguas.php',$data);
	//foreach ($dbquery as $fila) {
	//	echo '-> '.$fila['utz_lengua'].'</br>';
	//}
})->name('lenguas');

$app->get('/nueva/lengua',function() use($app){
	$app->render('nuevaLeng.php');
});

$app->post('/nueva/lengua',function() use($app,$db){
	$request = $app->request;
	$lengua = $request->post('lengua');

	//insertamos el dato
	$dbquery = $db->prepare("INSERT INTO utz_lengua(utz_lengua) values(:lengua)");
	$insertado = $dbquery->execute(array(':lengua'=>$lengua));
	if($insertado){
		$app->flash('message', 'Lengua Insertada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al guardar datos');		
	}
	$app->redirect('../lenguas');
});

$app->get('/nueva/:id/palabra', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_lengua WHERE utz_idLengua=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->halt(404, 'Lengua no Encontrada');
	}
	$app->render('nuevaPalabra.php',$data);
});



$app->run();