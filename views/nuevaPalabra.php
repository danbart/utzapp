<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva Palabra en "<?php echo $utz_lengua; ?>" </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Nueva Palabra en "<?php echo $utz_lengua; ?>" </legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="palaba">Palabra </label>
				<input type="text" class="form-control" id="palabra" name="palabra" placeholder="Ingrese Palabra" ><br />
				<label for="descrip">Descripción </label>
				<textarea rows="4" cols="30" type="text" class="form-control" id="descrip" name="descrip" placeholder="Ingrese una breve descripción" >	</textarea> <br />
				<label for="audio">Audio </label>
				<input type="text" class="form-control" id="audio" name="audio" placeholder="link" >		
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
		
	</div>
	
</body>
</html>