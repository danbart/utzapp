<?php require 'header.html'; ?>
<script >
            document.title='Listado de palabras en Lengua';
    </script>
	<div class="container">		
		<div style="margin: 0 auto;max-width: 330px;padding: 15px; text-align: center; ">
			<legend>Listado de palabras en Lengua</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
						
		</div>
		<h1>Listado: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>NO</th>
					      <th>PALABRA</th>
					      <th>DESCRIPCION</th>
					      <th>LENGUA</th>
					      <th>EDITAR</th>
					    </tr>
					  </thead>
					  <tbody><?php $cont=1;?>
						<?php foreach ($listspanish as $key => $value):?>
						<tr>
							<td><?php echo $cont;?></td>
							<td><?php echo $value['palabra']; ?></td>
							<td><?php echo $value['descripcion']; ?></td>
							<td><?php echo $value['lengua']; ?></td>
							<td><a href="./editar/<?php echo $value['idPalabra']; ?>/plengua" >editar</a></td>
						</tr>
						<?php $cont+=1;?>
					  <?php endforeach; ?>
					</tbody>
	</div>

</body>
</html>