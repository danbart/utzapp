<?php require 'header.html';
	if($validar){
  echo "<script>window.location='/';</script>";
  };
 ?>
<script >
            document.title='Iniciar Sesión';
    </script>
    <script src="/js/md5.pack.js" type="text/javascript" ></script>
	<div class="container">
	
		<form method="POST" id="inicioses" name="inicioses" role="form" style="margin: 0 auto;max-width: 490px;padding: 15px;" accept-charset="utf-8" onsubmit="return nosubmit(event)">
			<legend>Iniciar Sesión</legend>
			
			<div class="form-group">
				<label for="logusuario">Usuario</label><span style="color:red">*</span>
				<input type="text" class="form-control" id="logusuario" name="logusuario" placeholder="Ingrese Usuario"  required="required" ><br />				
				<label for="logpassword">Contraseña</label><span style="color:red">*</span>
				<input type="password" class="form-control" id="logpassword" name="logpassword" placeholder="Ingrese Contraseña"  required="required" ><br />				
				</div>
				<div id="validation"></div>	<br />			
			<button type="submit"  class="btn btn-primary" >Iniciar</button>
		</form>
		
	</div>
	<span>* Campo Requerido</span>

<script type="text/javascript">
	
	function loginUtz(){
	var $datos = document.inicioses.logusuario.value;
	var $pass = md5(document.inicioses.logpassword.value);
	if($datos!=""){
		$.ajax({
			type: "POST",
			url: "/views/inisesion.php",
			data: "logusuario="+$datos+"&logpassword="+$pass,
			dateType: "html",
			beforeSend: function(){
                    //imagen de carga
                    $("#validation").html("<p align='center'><img src='/img/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                    alert("Contraseña o usuario no encontrado");
                    },
                    success: function(response){
                    $("#validation").empty();
                    $("#validation").html(response);
            }
		});
	}
};


function nosubmit(e){
	e.preventDefault();
	if(loginUtz()){
		alert('funciona');
		 //document.getElementById("inicioses").submit();
	}else
	$("#validation").html("<p align='center'><img src='/img/ajax-loader.gif' /></p>");                    
}
</script>
</body>
</html>