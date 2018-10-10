<?php require 'header.html'; 
	if(!$validar){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Comentar Palabra en Lengua';
    </script>
	<div class="container">
		<div role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<legend>Comentar Palabra en Lengua </legend>
			
			<div class="form-group">
				<label for="palaba">Palabra</label>
				<h3 class="well" style="aling-text: center"><?php echo $ulengua['utz_palabra']; ?></h3><br />
				<label for="descrip">Descripción</label>
				<textarea rows="4" cols="30" type="text" class="form-control" id="descrip" disabled ><?php echo $ulengua['utz_descripcionLeng']; ?></textarea> 
				<!--label for="audio">Audio </label>
				<input type="text" class="form-control" id="audio" name="audio" placeholder="link" -->		
			</div>			
		</div>

		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px;padding: 15px;" accept-charset="utf-8">
			<div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">comentar como: </h3></div>
			<div class="panel-body"><?php echo $_SESSION["user"]["userlog"]; ?></div></div>
			
			<div class="form-group">				
				<input type="hidden" class="form-control" id="idusuario" name="idusuario" value="<?php echo $_SESSION['user']['iduserlog'] ?>" >
				<br />
				<label for="descrip">Comentario</label><span style="color:red">*</span>
				<textarea rows="4" cols="30" type="text" class="form-control" id="comentleng" name="comentleng" placeholder="Ingrese una breve descripción"  required="required"  ></textarea> <br />
				<!--label for="audio">Audio </label>
				<input type="text" class="form-control" id="audio" name="audio" placeholder="link" -->		
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Comentar</button>
		</form>
		<span>* Campo Requerido</span><br />
		<?php if($listcoment){?>
		<h1>Comentarios: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>NO</th>
					      <th>USUARIO</th>
					      <th>COMENTARIO</th>				      
					    </tr>
					  </thead>
					  <tbody><?php $cont=1;?>
						<?php foreach($listcoment as $key => $value):?>
						<tr>
							<td><?php echo $cont;?></td>
							<td><?php echo $value['nomusuario']; ?></td>
							<td><?php echo $value['comentario']; ?></td>
						</tr>
						<?php $cont+=1;?>
					  <?php endforeach; ?>
					</tbody>
					
		<?php }
		else { echo '<h3 class="well" >No se encontro ningun comentario "Se tu el primero"</h3>'; }?>
	</div>
	
</body>
</html>