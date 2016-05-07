<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Relacione Palabras</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;padding: 15px;" accept-charset="utf-8">
			<legend>Relacione Palabras</legend>			
			<div class="form-group">
				<label for="palabaEs" class="col-lg-2 control-label">Palabra Español</label>
				<div class="col-lg-10">
				<select class="form-control" id="espaniol" style="width: 26%;">
				  <option value="">seleccione</option>
				  <?php foreach ($spanish as $key => $value):?>
				  <option value="<?php echo $value['utz_idPalabra']?>"><?php echo $value['utz_palabra']?></option>
				  <?php endforeach; ?>
				</select>				
				</div>
				<label for="descripEs" class="col-lg-2 control-label">Palabra en Lengua </label>
				<div class="col-lg-10">
				<select class="form-control" id="lenguapal" style="width: 26%;">
				  <option value="">seleccione</option>
				  <?php foreach ($plengua as $key => $value):?>
				  <option value="<?php echo $value['utz_idPalabraLeng']?>"><?php echo $value['utz_palabra']?> <?php echo $value['utz_lengua']?></option>
				  <?php endforeach; ?>
				</select>	
				</div>
			</div>
			<div class="from-group" style="height: 20px">				
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
		
	</div>
	
</body>
</html>