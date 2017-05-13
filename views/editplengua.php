
<?php require 'header.html'; 
	if(!$validarAdmin){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Editar Palabra en Lengua';
    </script>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Editar Palabra en Lengua </legend>
			
			<div class="form-group">
				<label for="palaba">Palabra</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="palabraleng" name="palabraleng" placeholder="Ingrese Palabra"  required="required" value="<?php echo $utz_palabra; ?>" ><br />
				<label for="descrip">Descripción</label><span style="color:red">*</span>
				<textarea rows="4" cols="30" type="text" class="form-control" id="descrip" name="descrip" placeholder="Ingrese una breve descripción"  required="required"  ><?php echo $utz_descripcionLeng; ?></textarea> <br />
				<!--label for="audio">Audio </label>
				<input type="text" class="form-control" id="audio" name="audio" placeholder="link" -->		
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		</form>
		
	</div>
	<span>* Campo Requerido</span>
</body>
</html>