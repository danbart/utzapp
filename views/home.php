<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Diccionario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form action="" method="GET" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Diccionario de Lenguas Mayas</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="pespa">Buscar</label>
				<input type="text" class="form-control" id="serch" name="serch" placeholder="Ingrese Palabra en Español" >				
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<!--button type="submit" class="btn btn-primary">Buscar</button -->
		</form>

		<h1>Diccionario: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>ESPAÑOL</th>
					      <th>PALABRA</th>
					      <th>LENGUA</th>
					    </tr>
					  </thead>
					  <tbody>
			<?php foreach ($diccionario as $key => $value):?>
			<?php endforeach; ?>
	</div>
	
</body>
</html>
