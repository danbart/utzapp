
<?php require 'header.html'; 
	if(!$validar){
  echo "<script>window.location='/';</script>";
  };
?>
<script >
            document.title='Lenguas';
    </script>
	<div class="container">
		<div style="margin: 0 auto;max-width: 330px;padding: 15px">	
			<h1>Lenguas: </h1>
			<?php foreach ($lenguas as $key => $value):?>
				<div class="row">
					<div class="col-md-5"><?php echo $value['utz_lengua']; ?></div>
					<div class="col-md-7">
					<?php if($validarAdmin){?>
						<a href="editar/<?php echo $value['utz_idLengua']?>/lengua" >Editar</a>
						<?php }?>
						<a href="nueva/<?php echo $value['utz_idLengua']?>/palabra" >Agregar Palabra</a>
					</div>
				</div>
			<?php endforeach; ?>
			<?php if($validarAdmin){?>
			<a href="nueva/lengua">Agregar Lengua</a>
			<?php }?>
		</div>
	</div>
</body>
</html>