
<?php require 'header.html'; ?>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Editar Lengua</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<label for="Lengua">Lengua</label>
				<input type="text" class="form-control" id="lengua" name="lengua" placeholder="Ingrese Lengua" value="<?php echo $utz_lengua; ?>">				
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		</form>
		
	</div>
	
</body>
</html>