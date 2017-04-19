<?php require 'header.html'; ?>
<script >
            document.title='Iniciar Sesión';
    </script>
	<div class="container">
	
		<form action="./" method="POST" id="inicioses" name="inicioses" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8">
			<legend>Iniciar Sesión</legend>
			
			<div class="form-group">
				<label for="logusuario">Usuario</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="logusuario" name="logusuario" placeholder="Ingrese Usuario"  required="required" ><br />				
				<label for="logpassword">Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="logpassword" name="logpassword" placeholder="Ingrese Contraseña"  required="required" onChange="javascript:validar_clave()" >
				<p class="label label-danger" id="alertpass1" name="alertpass1" style="display: none;"></p><br />				
				</div><br />				
			<button type="submit"  class="btn btn-primary" onclick="return nosubmit(event)">Guardar</button>
		</form>
		
	</div>
	<span>* Campo Requerido</span>

<script type="text/javascript">
	
	function loginUtz(){
	var $datos = document.inicioses.logusuario.value;
	var $pass = document.inicioses.logpassword.value;
	if($datos!=""){
		$.ajax({
			type: "POST",
			url: "./views/serchus.php",
			data: "logusuario="+$datos+"&logpassword="+$pass,
			dateType: "json",
			beforeSend: function(){
                    //imagen de carga
                    $("#serchusua").html("<p align='center'><img src='./img/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                    alert("error petición ajax");
                    },
                    success: function(data){
                    if(data.result==ture){

                    } else {
                    	$("#serchusua").empty();
                    	$("#serchusua").append(data);
                    }    
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
	alert('Contraseña no valida');
}
</script>
</body>
</html>