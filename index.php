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
//$db= new PDO('mysql:host=localhost;dbname=utzdb_complet','root','danilosolos');
$db= new PDO('mysql:host=mysql.hostinger.es;dbname=u265929643_utzap','u265929643_danil','dansrodas');

$app->notFound(function () use ($app) {
    $app->render('404.php');
});

$app->get('/',function()  use($app, $db){	
	$dbquery = $db->prepare('SELECT sh.utz_palabra as espanol, pl.utz_palabra as palabra, lg.utz_lengua as lengua from utz_palabra pl inner join utz_spanish_has_utz_palabra sp on pl.utz_idPalabraLeng=sp._idPalabraLeng inner join utz_spanish sh on sp._utz_idPalabra=sh.utz_idPalabra inner join utz_lengua lg on lg.utz_idLengua=pl._utz_idLengua order by sh.utz_palabra asc');
	$dbquery->execute();
	$data['diccionario'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('home.php',$data);
});



$app->get('/search/:bpalabra', function($bpalabra) use($app, $db){
	//$request = $app->request;
	//$bpalabras = "%".$request->post('palabra')."%";
	$bpalabras1= $bpalabra;
	$bpalabras = $bpalabra;
	$dbquery = $db->prepare('SELECT sh.utz_palabra as espanol, pl.utz_palabra as palabra, lg.utz_lengua as lengua, pl.utz_descripcionLeng as descripcion from utz_palabra pl inner join utz_spanish_has_utz_palabra sp on pl.utz_idPalabraLeng=sp._idPalabraLeng inner join utz_spanish sh on sp._utz_idPalabra=sh.utz_idPalabra inner join utz_lengua lg on lg.utz_idLengua=pl._utz_idLengua WHERE sh.utz_palabra LIKE :esp OR pl.utz_palabra LIKE :leng ORDER by sh.utz_palabra ASC ');
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
	$app->render('serch.php', $data);

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
	$app->redirect('/lenguas');
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
	$dbquery = $db->prepare("SELECT * FROM utz_spanish ORDER by utz_idPalabra asc");
	$dbquery2 = $db->prepare("SELECT P.utz_idPalabraLeng, P.utz_palabra, L.utz_lengua FROM utz_palabra P INNER JOIN utz_lengua L ON L.utz_idLengua=P._utz_idLengua ORDER BY P.utz_idPalabraLeng asc");
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
	$app->redirect('/espaniollengua');

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
	$dbquery = $db->prepare("SELECT * FROM utz_spanish ORDER by utz_palabra asc");
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
	$app->redirect('/list-spanish');
});


$app->get('/list-plengua', function() use($app, $db) {
	$dbquery = $db->prepare("SELECT pl.utz_idPalabraLeng as idPalabra, pl.utz_palabra as palabra, pl.utz_descripcionLeng as descripcion, lg.utz_idLengua as idLengua, lg.utz_lengua as lengua from utz_palabra pl inner join utz_lengua lg on pl._utz_idLengua=lg.utz_idLengua  order by pl.utz_palabra asc");
	$dbquery->execute();
	$data['listspanish'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('list-plengua.php', $data);
});

$app->get('/editar/:id/plengua', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_palabra WHERE utz_idPalabraLeng=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('editplengua.php',$data);
});

$app->post('/editar/:id/plengua', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$palabraLeng = $request->post('palabraleng');
	$descrip = $request->post('descrip');

	//insert palabras 
	$dbquery = $db->prepare("UPDATE utz_palabra SET utz_palabra =:palabra, utz_descripcionLeng = :descrip WHERE utz_idPalabraLeng=:id");
	$insertado = $dbquery->execute(array(':palabra'=>$palabraLeng, ':descrip'=>$descrip, ':id'=>$id));
	
	if($insertado){
		$app->flashNow('message', 'Palabra actualizada Exitosamente');
	}else{
		$app->flashNow('error', 'Se produjo un error al actualizar datos');		
	}
	$app->redirect('/list-plengua');
});

$app->get('/registro', function() use($app, $db){


	$app->render('registro-usuario.php');
});

$app->post('/registro', function() use($app, $db){

	$request = $app->request;

				$regusuario = $request->post('regusuario');
				$regnombre = $request->post('regnombre');
				$regapellido = $request->post('regapellido');
				$regemail = $request->post('regemail');
				$regpasswordconf = md5($request->post('regpasswordconf'));
			
					$dbquery = $db->prepare("INSERT INTO utz_usuario (utz_usuario, utz_Nombre, utz_adminitrador, utz_Apellido, utz_email, utz_password,  _utz_idDiccionario) values (:regusuario, :regnombre, '0', :regapellido, :regemail, :regpasswordconf, '1')");
					$insertado = $dbquery->execute(array(':regusuario'=>$regusuario, ':regnombre'=>$regnombre, ':regapellido'=>$regapellido, ':regemail'=>$regemail, ':regpasswordconf'=>$regpasswordconf));
			
$app->redirect('/inicio-sesion/');
	
});

$app->get('/inicio-sesion/', function() use($app, $db){

	$app->render('sesion.php');

});

$app->post('/inicio-sesion/', function() use($app, $db){

	$app->render('sesion.php');

});

$app->get('/list-usuarios', function() use($app, $db) {
	$dbquery = $db->prepare("SELECT utz_idusuario as idusuario, utz_adminitrador as administrador, utz_usuario as usuario, utz_Nombre as nombre, utz_Apellido as apellido, utz_email as email from utz_usuario order by utz_Apellido asc");
	$dbquery->execute();
	$data['lisusuarios'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	$app->render('list-users.php', $data);
});

$app->get('/editar/:id/usuario', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_usuario WHERE utz_idusuario=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('edit-usuario.php',$data);
});

$app->post('/editar/:id/usuario', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$renommbre = $request->post('regnombre');
	$regapellido = $request->post('regapellido');
	$regemail = $request->post('regemail');
	$regadmin = $request->post('regadmin');

	//insert palabras 
	$dbquery = $db->prepare("UPDATE utz_usuario SET utz_Nombre =:renommbre, utz_Apellido = :regapellido, utz_email = :regemail, utz_adminitrador = :regadmin WHERE utz_idusuario=:id");
	$insertado = $dbquery->execute(array(':renommbre'=>$renommbre, ':regapellido'=>$regapellido, ':regemail'=>$regemail, ':regadmin'=>$regadmin, ':id'=>$id));
	
	if($insertado){
		$app->flashNow('message', 'Palabra actualizada Exitosamente');
	}else{
		$app->flashNow('error', 'Se produjo un error al actualizar datos');		
	}
	$app->redirect('/list-usuarios');
});

$app->get('/editar/:id/perfil', function($id=0) use($app, $db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_usuario WHERE utz_idusuario=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('edit-profile.php',$data);
});

$app->post('/editar/:id/perfil', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$renommbre = $request->post('regnombre');
	$regapellido = $request->post('regapellido');
	$regemail = $request->post('regemail');

	//insert palabras 
	$dbquery = $db->prepare("UPDATE utz_usuario SET utz_Nombre =:renommbre, utz_Apellido = :regapellido, utz_email = :regemail WHERE utz_idusuario=:id");
	$insertado = $dbquery->execute(array(':renommbre'=>$renommbre, ':regapellido'=>$regapellido, ':regemail'=>$regemail, ':id'=>$id));
	
	if($insertado){
		$app->flashNow('message', 'Palabra actualizada Exitosamente');
	}else{
		$app->flashNow('error', 'Se produjo un error al actualizar datos');		
	}
	$app->redirect('/perfil');
});

$app->get('/perfil', function($id=0) use($app, $db){
	$id = $_SESSION['user']['iduserlog'];//(int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_usuario WHERE utz_idusuario=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data = $dbquery->fetch(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('profile.php',$data);
});

$app->get('/comentar/:id/palabra', function($id) use($app,$db){
	$id = (int)$id;
	//buscamos lengua
	$dbquery = $db->prepare("SELECT * FROM utz_palabra WHERE utz_idPalabraLeng=:id LIMIT 1");
	$dbquery->execute(array(':id'=>$id));
	$data['ulengua'] = $dbquery->fetch(PDO::FETCH_ASSOC);

	$dbquery = $db->prepare("SELECT us.utz_usuario AS nomusuario, com.utz_comentario AS comentario FROM utz_usuario us INNER JOIN utz_comentarios com ON us.utz_idusuario = com._utz_idusuario INNER JOIN utz_palabra pl ON com._utz_idPalabraLeng = pl.utz_idPalabraLeng WHERE pl.utz_idPalabraLeng=:id ");
	$dbquery->execute(array(':id'=>$id));
	$data['listcoment'] = $dbquery->fetchAll(PDO::FETCH_ASSOC);
	if(!$data){
		$app->notFound();
	}
	$app->render('coment-plengua.php',$data);
});

$app->post('/comentar/:id/palabra', function($id) use($app,$db){
	$id = (int)$id;
	$request = $app->request;
	$idusuario = $request->post('idusuario');
	$comentleng = $request->post('comentleng');
	//$linkAudio = $request->post('audio');	':audio'=>$linkAudio,

	//insert palabras 
	$dbquery = $db->prepare("INSERT INTO utz_comentarios(utz_comentario, _utz_idPalabraLeng, _utz_idusuario) values (:comentleng, :id, :idusuario)");
	$insertado = $dbquery->execute(array(':comentleng'=>$comentleng, ':id'=>$id,  ':idusuario'=>$idusuario));
	
	if($insertado){
		$app->flash('message', 'Palabra Insertada Exitosamente');
	}else{
		$app->flash('error', 'Se produjo un error al guardar datos');		
	}
	$app->redirect('/comentar/'.$id.'/palabra');
});

$app->run();