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
					      <?php if($validar){?>
					      <th>EDITAR</th>
					      <?php }?>
					    </tr>
					  </thead>
					  <tbody><?php $cont=1;?>
						<?php foreach ($listspanish as $key => $value):?>
						<tr>
							<td><?php echo $cont;?></td>
							<td><?php echo $value['utz_palabra']; ?></td>
							<td><?php echo $value['utz_descripcion']; ?></td>
							<?php if($validar){?>
							<td><a href="./editar/<?php echo $value['utz_idPalabra']; ?>/palabraspanol" >editar</a></td>
							<?php }?>
						</tr>
						<?php $cont+=1;?>
					  <?php endforeach; ?>
					</tbody>
	</div>
	
</head>
</body>
</html>