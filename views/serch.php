
<?php require 'header.html'; ?>
<script >
            document.title='Busqueda de Palabras';
    </script>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Diccionario de Lenguas Mayas</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
			<div class="form-group">
				<!--label for="pespa">Buscar</label>
				<input type="text" class="form-control" id="palabra" name="palabra" placeholder="Ingrese Palabra en Español" value="" -->				
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
					    <tr class="active">
					      <th>ESPAÑOL</th>
					      <th>PALABRA</th>
					      <th>DESCRIPCION</th>
					      <th>LENGUA</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php foreach ($diccionario as $key => $value):?>
						<tr>
							<td><?php echo $value['espanol']; ?></td>
							<td><?php echo $value['palabra']; ?></td>
							<td><?php echo $value['descripcion']; ?></td>
							<td><?php echo $value['lengua']; ?></td>	
						</tr>
					  <?php endforeach; ?>
					</tbody>
	</div>
	
</body>
</html>