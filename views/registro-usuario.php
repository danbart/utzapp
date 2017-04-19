<?php require 'header.html'; ?>
<script >
            document.title='Registro';
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<div class="container">
	<script type="text/javascript" href="./js/regjs.js" ></script>
		<form action="#" method="POST" id="registrous" name="registrous" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8">
			<legend>Registro</legend>
			
			<div class="form-group">
				<label for="regusuario">Usuario</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regusuario" name="regusuario" placeholder="Ingrese Usuario"  required="required" onchange="valid_usuario()" >
				<div  name="serchusua" id="serchusua" ></div>
				<br />
				<label for="regnombre">Nombre Completo</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regnombre" name="regnombre" placeholder="Ingrese Nombre Completo"  required="required" ><br />
				<label for="regapellido">Apellidos</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="regapellido" name="regapellido" placeholder="Ingrese Apellido Completo"  required="required" ><br />
				<label for="regemail">Correo Electronico</label><span style="color:red">*</span>
				<input type="email" class="form-control" id="regemail" name="regemail" placeholder="Ingrese Correo Electronico"  required="required" >	
				<br />
				<label for="regpassword">Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="regpassword" name="regpassword" placeholder="Ingrese Contraseña"  required="required" onChange="javascript:validar_clave()" >
				<p class="label label-danger" id="alertpass1" name="alertpass1" style="display: none;"></p><br />
				<label for="regpasswordconf">Repita Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="regpasswordconf" name="regpasswordconf" placeholder="Repita su Contraseña"  required="required" onChange="javascript:validar_clave()" >
				<div class="label label-danger" name="alert2" id="alert2" style=" display: none;">
				  
				</div><br />
				<!--button	class="g-recaptcha"	data-sitekey="6LdEkh0UAAAAAGLs0AEwID96BWIaOwBzAimZI0kD" data-callback="YourOnSubmitFn">
						Enviar
						</button-->	
						<div class="g-recaptcha" data-sitekey="6Ld6hB0UAAAAAAWk_sML1k391A04BPdo5Fs-M9wP"></div>
			</div>
			<div class="form-group" style="height: 20px">
				<?php if(isset($flash['menssage'])): ?>
					<p class="text-succes"><?php echo $flash['message'] ?></p>
				<?php endif; ?>
			</div>
			<button type="submit"  class="btn btn-primary" onclick="return nosubmit(event)">Guardar</button>
		</form>
		
	</div>
	<span>* Campo Requerido</span>

<script type="text/javascript">
	
	function validar_clave() {

		document.getElementById("alertpass1").style.display="none";
		document.getElementById("alert2").style.display="none";
var caract_invalido = " ";
var caract_longitud = 8;
var cla1 = document.registrous.regpassword.value;
var cla2 = document.registrous.regpasswordconf.value;
if (document.registrous.regpassword.value.length < caract_longitud) {

document.getElementById('alertpass1').innerHTML="Tu clave debe constar de minimo " + caract_longitud + " caracteres.";
document.getElementById("alertpass1").style.display="inline";
return false;
}
if (document.registrous.regpassword.value.indexOf(caract_invalido) > -1) {
document.getElementById('alertpass1').innerHTML="caracter invalido";
document.getElementById("alertpass1").style.display="inline";
return false;
}
else {
if (cla1 != cla2) {
document.getElementById('alert2').innerHTML="Las claves no son identicas";
document.getElementById("alert2").style.display="inline";
return false;
}
else {
document.getElementById('alert2').innerHTML="La contraseña es correcta";
document.getElementById("alert2").style.display="inline";
document.getElementById('alert2').className ="label label-success";
return true;
      }
   }
}

function valid_usuario(){
	var $datos = document.registrous.regusuario.value;
	if($datos!=""){
		$.ajax({
			type: "POST",
			url: "./views/serchus.php",
			data: "regusuario="+$datos,
			dateType: "html",
			beforeSend: function(){
                    //imagen de carga
                    $("#serchusua").html("<p align='center'><img src='./img/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                    alert("error petición ajax");
                    },
                    success: function(data){                                                    
                    $("#serchusua").empty();
                    $("#serchusua").append(data);

                    }
		});
	}
};


function nosubmit(e){
	e.preventDefault();
	if(validar_clave()){
		//alert('funciona');
		 document.getElementById("registrous").submit();
	}else
	alert('Dato no valido');
}
</script>
</body>
</html>