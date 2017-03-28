<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Diccionario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
	<div class="container">		
		<div style="margin: 0 auto;max-width: 330px;padding: 15px;">
			<legend>Diccionario de Lenguas Mayas</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="pespa">Buscar</label>
				<input type="search" class="form-control" id="palabra" name="palabra" placeholder="Ingrese Palabra en Español" >				
			</div><button onclick="busqueda()"  class="btn btn-primary">Buscar</button>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>			
		</div>
		<h1>Diccionario: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>ESPAÑOL</th>
					      <th>PALABRA</th>
					      <th>LENGUA</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php foreach ($diccionario as $key => $value):?>
						<tr>
							<td><?php echo $value['espanol']; ?></td>
							<td><?php echo $value['palabra']; ?></td>
							<td><?php echo $value['lengua']; ?></td>	
						</tr>
					  <?php endforeach; ?>
					</tbody>
	</div>
	<script >
			function busqueda() {
				//obtiene el valor del input y lo envia al url
				var palabra = document.getElementById("palabra").value;				
    		 window.location.assign("./search/"+palabra);
		};
	</script>
</head>
</body>
</html>