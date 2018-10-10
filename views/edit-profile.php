<?php require 'header.html'; 
	if(!$validar){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Actualizacion de usuario';
    </script>    
	<div class="container">	
		<form method="POST" id="registrous" name="registrous" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8" >
			<legend>Actualizacion de Datos</legend>
			
			<div class="form-group">
				<label for="regusuario">Usuario</label>
				<h3 class="well" style="aling-text: center"><?php echo $utz_usuario; ?></h3>
				<br />
				<label for="regnombre">Nombre</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regnombre" name="regnombre" placeholder="Ingrese Nombre Completo"  required="required" value="<?php echo $utz_Nombre; ?>" ><br />
				<label for="regapellido">Apellidos</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regapellido" name="regapellido" placeholder="Ingrese Apellido Completo"  required="required" value="<?php echo $utz_Apellido; ?>"  ><br />
				<label for="regemail">Correo Electronico</label><span style="color:red">*</span>
				<input type="email" class="form-control" id="regemail" name="regemail" placeholder="Ingrese Correo Electronico"  required="required" value="<?php echo $utz_email; ?>" >	
				<br />				
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit"  class="btn btn-primary" onclick="">Actualizar</button>
			<a href="/perfil" class="btn btn-primary">Cancelar</a>
		</form>
		<script type="text/javascript" language="javascript">
		jQuery("#keycode").hide();
	</script> 
	</div>
	<span>* Campo Requerido</span>

</script>
</body>
</html>