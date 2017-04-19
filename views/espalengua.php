
<?php require 'header.html'; ?>
<script >
            document.title='Relacione Palabras';
    </script>
	<div class="container">
	<div style="margin: 0 auto;max-width: 330px;padding: 15px;  ">
		<form action="" method="POST" role="form" style="margin: 0 auto;max-width: 330px; padding: 15px;" accept-charset="utf-8">
			<legend>Relacione Palabras</legend>			
			<div class="form-group">
				<label for="palabaEs" >Palabra Español<span style="color:red">*</span></label><br />				
				<select class="form-control" id="espaniol" name="espaniol"  required="required" >
				  <option value="">seleccione</option>
				  <?php foreach ($spanish as $key => $value):?>
				  <option value="<?php echo $value['utz_idPalabra']?>"><?php echo $value['utz_palabra']?></option>
				  <?php endforeach; ?>
				</select>	
				<label for="descripEs" ">Palabra en Lengua<span style="color:red">*</span></label><br />
				<select class="form-control" id="lenguapal" name="lenguapal"  required="required" >
				  <option value="">seleccione</option>
				  <?php foreach ($plengua as $key => $value):?>
				  <option value="<?php echo $value['utz_idPalabraLeng']?>"><?php echo $value['utz_palabra']?> <?php echo $value['utz_lengua']?></option>
				  <?php endforeach; ?>
				</select>	
			</div>
			<div class="from-group" style="height: 20px">				
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
		
	</div>
	</div>
	<span>* Campo Requerido</span>
</body>
</html>