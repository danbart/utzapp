<?php require 'header.html'; ?>
<script >
            document.title='Registro';
    </script>
	<div class="container">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8">
			<legend>Registro</legend>
			
			<div class="form-group">
				<label for="regusuario">Usuario</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regusuario" name="regusuario" placeholder="Ingrese Usuario"  required="required" ><br />
				<label for="regnombre">Nombre Completo</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regnombre" name="regnombre" placeholder="Ingrese Nombre Completo"  required="required" ><br />
				<label for="regapellido">Apellidos</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regapellido" name="regapellido" placeholder="Ingrese Apellido Completo"  required="required" ><br />
				<label for="regemail">Correo Electronico</label><span style="color:red">*</span>
				<input type="email" class="form-control" id="regemail" name="regemail" placeholder="Ingrese Correo Electronico"  required="required" ><br />
				<label for="regpassword">Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="regpassword" name="regpasword" placeholder="Ingrese Nombre de Usuario"  required="required" ><br />
				<label for="regpasswordconf">Repita Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="regpasswordconf" name="regpaswordconf" placeholder="Ingrese Nombre de Usuario"  required="required" ><br />	
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
		
	</div>
	<span>* Campo Requerido</span>
</body>
</html>