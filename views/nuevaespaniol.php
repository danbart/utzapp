
<?php require 'header.html'; 
	if(!$validar){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Nueva Palabra en "Español"';
    </script>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Nueva Palabra en "Español" </legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="palabaEs">Palabra</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="palabraEs" name="palabraEs" placeholder="Ingrese Palabra" required="required" ><br />
				<label for="descripEs">Descripción </label>
				<textarea rows="4" cols="30" type="text" class="form-control" id="descripEs" name="descripEs" placeholder="Ingrese una breve descripción" ></textarea>	
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
		<span>* Campo Requerido</span>
	</div>
	
</body>
</html>