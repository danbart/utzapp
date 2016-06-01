<?php
session_start();
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->config(array(
		'debug' => true,
		'templates.path' => 'views',
	));
$db= new PDO('mysql:host=localhost;dbname=utzdb','root','danilosolos');
//$db= new PDO('mysql:host=mysql.hostinger.es;dbname=u265929643_utzap','u265929643_danil','dansrodas');


$app->get('/',function()  use($app, $db){	
	$dbquery = $db->prepare("SELECT sp.utz_palabra as espanol, pal.utz_palabra as palabra, lg.utz_lengua as lengua FROM utz_spanish sp INNER JOIN spanish_palabra spp on sp.utz_idPalabra=spp._utz_idPalabra INNER JOIN utz_palabra pal on pal.utz_idPalabraLeng=spp._utz_idPalabraLeng INNER JOIN utz_lengua lg on pal._utz_idLengua=lg.utz_idLengua ORDER by sp.utz_palabra ASC");
	$dbquery->execute();
	$data['diccionario'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('home.php',$data);
});

$app->get('/serch',function()  use($app){
	$app->render('home.php');
});

$app->post('/serch', function() use($app, $db){
	$request = $app->request;
	$palabra = $request->post('palabra');
	//$palabra = $palabra;
	$dbquery = $db->prepare('SELECT sp.utz_palabra as espanol, pal.utz_palabra as palabra, lg.utz_lengua as lengua FROM utz_spanish sp INNER JOIN spanish_palabra spp on sp.utz_idPalabra=spp._utz_idPalabra INNER JOIN utz_palabra pal on pal.utz_idPalabraLeng=spp._utz_idPalabraLeng INNER JOIN utz_lengua lg on pal._utz_idLengua=lg.utz_idLengu WHERE sp.utz_palabra LIKE "%:palabra%" OR pal.utz_palabra LIKE "%:palabra%" ORDER by sp.utz_palabra ASC');
	// 
	//$insertado=
	$dbquery->execute(array(':palabra'=>$palabra));
	$data['diccionario'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	//if($data){
	//	$app->flash('message', 'Resultados Esperados');		
	//}else{
	//	$app->flash('error', 'No se encontro ninguna palabra');		
	//}
	if(!$data){
		$app->halt(404, 'Palabra no Encontrada');
	}
	$app->render('home.php', $data);

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

$app->post('/nueva/:id/palabra', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$palabra = $request->post('palabra');
	$descripcion = $request->post('descrip');
	$linkAudio = $request->post('audio');	

	//insert palabras 
	$dbquery = $db->prepare("INSERT INTO utz_palabra(utz_palabra, utz_descripcionLeng, utz_audio, 	_utz_idLengua) values (:palabra, :descrip, :audio, :id)");
	$insertado = $dbquery->execute(array(':palabra'=>$palabra, ':descrip'=>$descripcion, ':audio'=>$linkAudio, ':id'=>$id));
	
	if($insertado){
		$app->flash('message', 'Palabra Insertada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al guardar datos');		
	}
	$app->redirect('./palabra');
});

$app->get('/nueva/palabraes', function() use($app){
	$app->render('nuevaespaniol.php');
})->name('espaniolname');

//agrega nuea palabra en espaniol
$app->post('/nueva/palabraes', function() use($app,$db){
	$request = $app->request;
	$palabraEs = $request->post('palabraEs');
	$descripEs = $request->post('descripEs');

	$dbquery = $db->prepare("INSERT INTO utz_spanish(utz_palabra, utz_consultado) values(:spanish, :descript)");
	$insertado = $dbquery->execute(array(':spanish'=>$palabraEs, ':descript'=>$descripEs));
	if($insertado){
		$app->flash('message', 'Lengua Insertada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al guardar datos');		
	}
	$app->redirect('./palabraes');
});

$app->get('/espaniollengua', function() use($app,$db){
	$dbquery = $db->prepare("SELECT * FROM utz_spanish");
	$dbquery2 = $db->prepare("SELECT P.utz_idPalabraLeng, P.utz_palabra, L.utz_lengua FROM utz_palabra P INNER JOIN utz_lengua L ON L.utz_idLengua=P._utz_idLengua ORDER BY L.utz_idLengua DESC");
	$dbquery->execute();
	$dbquery2->execute();
	$data['spanish'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$data['plengua'] = $dbquery2->fetchAll(PDO::FETCH_ASSOC);
	$app->render('espalengua.php',$data);
});

$app->post('/espaniollengua', function() use($app,$db){
	$request = $app->request;
	$palabraEs = $request->post('espaniol');
	$palabraleng = $request->post('lenguapal');

	$dbquery = $db->prepare("INSERT INTO spanish_palabra(_utz_idPalabra, _utz_idPalabraLeng) values(:spanish, :lenguapal)");
	$insertado = $dbquery->execute(array(':spanish'=>$palabraEs, ':lenguapal'=>$palabraleng));
	$app->redirect('./espaniollengua');

});



$app->run();