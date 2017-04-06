<?php require 'header.html'; ?>
<script >
            document.title='Editar Palabra';
    </script>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Editar Palabra en "Español" </legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="palabaEs">Palabra</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="palabraEs" name="palabraEs" placeholder="Ingrese Palabra" required="required" value="<?php echo $utz_palabra; ?>"><br />
				<label for="descripEs">Descripción </label><span style="color:red">*</span>
				<textarea rows="4" cols="30" type="text" class="form-control" id="descripEs" name="descripEs" placeholder="Ingrese una breve descripción" required="required"><?php echo $utz_descripcion; ?></textarea>	
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