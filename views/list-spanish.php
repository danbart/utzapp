<?php require 'header.html'; ?>
<script >
            document.title='Listado de palabras en Español';
    </script>
	<div class="container">		
		<div style="margin: 0 auto;max-width: 330px;padding: 15px; text-align: center; ">
			<legend>Listado de palabras en Español</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
						
		</div>
		<h1>Listado: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>ID</th>
					      <th>PALABRA</th>
					      <th>DESCRIPCION</th>
					      <th>EDITAR</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php foreach ($listspanish as $key => $value):?>
						<tr>
							<td><?php echo $value['utz_idPalabra']; ?></td>
							<td><?php echo $value['utz_palabra']; ?></td>
							<td><?php echo $value['utz_descripcion']; ?></td>
							<td><a href="./editar/<?php echo $value['utz_idPalabra']; ?>/palabraspanol" >editar</a></td>
						</tr>
					  <?php endforeach; ?>
					</tbody>
	</div>
	
</head>
</body>
</html>