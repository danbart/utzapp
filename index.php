<?php
//Urls api
//http://utzappumg.esy.es/
//http://utzappumg.esy.es/lenguas
//http://utzappumg.esy.es/serch/:palabra
//http://utzappumg.esy.es/nueva/lengua
//http://utzappumg.esy.es/nueva/:id/palabra
//http://utzappumg.esy.es/nueva/palabraes
//http://utzappumg.esy.es/espaniollengua
//http://utzappumg.esy.es/editar/:id/lengua

session_start();
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->config(array(
		'debug' => true,
		'templates.path' => 'views',
	));
$db= new PDO('mysql:host=localhost;dbname=utzdb_complet','root','danilosolos');


$app->notFound(function () use ($app) {
    $app->render('404.php');
});

$app->get('/',function()  use($app, $db){	
	$dbquery = $db->prepare('SELECT sh.utz_palabra as Español, pl.utz_palabra as Palabra, lg.utz_lengua from utz_palabra pl inner join utz_spanish_has_utz_palabra sp on pl.utz_idPalabraLeng=sp._idPalabraLeng inner join utz_spanish sh on sp._utz_idPalabra=sh.utz_idPalabra inner join utz_lengua lg on lg.utz_idLengua=pl._utz_idLengua group by lg.utz_lengua desc order by sh.utz_palabra desc');
	$dbquery->execute();
	$data['diccionario'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('home.php',$data);
});



$app->get('/search/:bpalabra', function($bpalabra) use($app, $db){
	//$request = $app->request;
	//$bpalabras = "%".$request->post('palabra')."%";
	$bpalabras1= $bpalabra;
	$bpalabras = $bpalabra;
	$dbquery = $db->prepare('SELECT sh.utz_palabra as Español, pl.utz_palabra as Palabra, lg.utz_lengua from utz_palabra pl inner join utz_spanish_has_utz_palabra sp on pl.utz_idPalabraLeng=sp._idPalabraLeng inner join utz_spanish sh on sp._utz_idPalabra=sh.utz_idPalabra inner join utz_lengua lg on lg.utz_idLengua=pl._utz_idLengua WHERE sh.utz_palabra LIKE :esp OR pl.utz_palabra LIKE :leng ORDER by sp.utz_palabra ASC ');
	$error ="Palabra no Encontrada";
	// 
	//$insertado=
	//$dbquery->bindValue(':bpalabra','%{$bpalabras}%');
	//$dbquery->execute(array(':bpalabra'=>'%{$bpalabras}%',':bpalabra1'=>'%{$bpalabras}%'));
	$dbquery->execute(array(':esp'=>'%'.$bpalabras1.'%',':leng'=>'%'.$bpalabras.'%'));
	$data['diccionario'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	//if($data){
	//	$app->flash('message', 'Resultados Esperados');		
	//}else{
	//	$app->flash('error', 'No se encontro ninguna palabra');		
	//}
	if(!$data['diccionario']){
		$app->notFound();
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
	$dbquery = $db->prepare("INSERT INTO utz_lengua(utz_lengua,_utz_idDiccionario) values(:lengua,'1')");
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
		$app->notFound();
	}
	$app->render('nuevaPalabra.php',$data);
});

$app->post('/nueva/:id/palabra', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$palabra = $request->post('palabra');
	$descripcion = $request->post('descrip');
	//$linkAudio = $request->post('audio');	':audio'=>$linkAudio,

	//insert palabras 
	$dbquery = $db->prepare("INSERT INTO utz_palabra(utz_palabra, utz_descripcionLeng, 	_utz_idLengua) values (:palabra, :descrip, :id)");
	$insertado = $dbquery->execute(array(':palabra'=>$palabra, ':descrip'=>$descripcion,  ':id'=>$id));
	
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

	$dbquery = $db->prepare("INSERT INTO utz_spanish(utz_palabra, utz_descripcion, _utz_idDiccionario) values(:spanish, :descript, '1')");
	$insertado = $dbquery->execute(array(':spanish'=>$palabraEs, ':descript'=>$descripEs));
	if($insertado){
		$app->flash('message', 'Lengua Insertada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al guardar datos');		
	}
	$app->redirect('./palabraes');
});

$app->get('/espaniollengua', function() use($app,$db){
	$dbquery = $db->prepare("SELECT * FROM utz_spanish ORDER by utz_idPalabra DESC");
	$dbquery2 = $db->prepare("SELECT P.utz_idPalabraLeng, P.utz_palabra, L.utz_lengua FROM utz_palabra P INNER JOIN utz_lengua L ON L.utz_idLengua=P._utz_idLengua ORDER BY P.utz_idPalabraLeng DESC");
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

	$dbquery = $db->prepare("INSERT INTO utz_spanish_has_utz_palabra(_utz_idPalabra, _idPalabraLeng) values(:spanish, :lenguapal)");
	$insertado = $dbquery->execute(array(':spanish'=>$palabraEs, ':lenguapal'=>$palabraleng));
	$app->redirect('./espaniollengua');

});

$app->get('/editar/:id/lengua', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_lengua WHERE utz_idLengua=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('editarlengua.php',$data);
});

$app->post('/editar/:id/lengua', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$lengua = $request->post('lengua');	

	//insert palabras 
	$dbquery = $db->prepare("UPDATE utz_lengua SET utz_lengua =:lengua WHERE utz_idLengua=:id");
	$insertado = $dbquery->execute(array(':lengua'=>$lengua, ':id'=>$id));
	
	if($insertado){
		$app->flash('message', 'Palabra actualizada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al actualizar datos');		
	}
	$app->redirect('/lenguas');
});

$app->get('/list-spanish', function() use($app, $db) {
	$dbquery = $db->prepare("SELECT * FROM utz_spanish ORDER by utz_idPalabra DESC");
	$dbquery->execute();
	$data['listspanish'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('list-spanish.php', $data);
});

$app->get('/editar/:id/palabraspanol', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_spanish WHERE utz_idPalabra=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('editpalspan.php',$data);
});

$app->post('/editar/:id/palabraspanol', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$palabraEs = $request->post('palabraEs');
	$descripEs = $request->post('descripEs');

	//insert palabras 
	$dbquery = $db->prepare("UPDATE utz_spanish SET utz_palabra =:palabra, utz_descripcion = :descripEs WHERE utz_idPalabra=:id");
	$insertado = $dbquery->execute(array(':palabra'=>$palabraEs, ':descripEs'=>$descripEs, ':id'=>$id));
	
	if($insertado){
		$app->flash('message', 'Palabra actualizada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al actualizar datos');		
	}
	$app->redirect('../list-spanish');
});



$app->run();