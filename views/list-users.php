<?php require 'header.html'; 
if(!$validarAdmin){
  echo "<script>window.location='/';</script>";
  };
  ?>
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
					      <th>USUARIO</th>
					      <th>NOMBRE</th>
					      <th>EMAIL</th>
					      <th>ADMINISTRADOR</th>					     
					      <th>EDITAR</th>					      
					    </tr>
					  </thead>
					  <tbody><?php $cont=1;?>
						<?php foreach ($lisusuarios as $key => $value):?>
						<tr>
							<td><?php echo $cont;?></td>
							<td><?php echo $value['usuario']; ?></td>
							<td><?php echo $value['apellido'].' '.$value['nombre']; ?></td>
							<td><?php echo $value['email']; ?></td>
							<td><input type="checkbox" id="admin" checked="<?php echo $value['administrador']; ?>"></td>
							<?php if($validar){;?>
							<td><a href="./editar/<?php echo $value['idusuario']; ?>/usuario" >editar</a></td>
							<?php }?>
						</tr>
						<?php $cont+=1;?>
					  <?php endforeach; ?>
					</tbody>
	</div>

</body>
</html>