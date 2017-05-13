<?php require 'header.html'; 
	if(!$validar){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Mi Perfil';
    </script>    
	<div class="container">	
		<form method="POST" id="registrous" name="registrous" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8" >
			<legend>Mi Perfil</legend>
			
			<div class="form-group">
				<label for="regusuario">Usuario</label>
				<h3 class="well" style="aling-text: center"><?php echo $utz_usuario; ?></h3>
				<br />
				<label for="regnombre">Nombre</label>
				<h3 class="well" style="aling-text: center"><?php echo $utz_Nombre; ?></h3><br />
				<label for="regapellido">Apellidos</label>
				<h3 class="well" style="aling-text: center"><?php echo $utz_Apellido; ?></h3><br />
				<label for="regemail">Correo Electronico</label>
				<h3 class="well" style="aling-text: center"><?php echo $utz_email; ?></h3>	
				<br />				
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<a href="/editar/<?php echo $_SESSION['user']['iduserlog'];?>/perfil"  class="btn btn-primary" >Editar</a>
		</form>
		<script type="text/javascript" language="javascript">
		jQuery("#keycode").hide();
	</script> 
	</div>

</script>
</body>
</html>