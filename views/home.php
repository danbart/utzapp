
<?php require 'header.html'; ?>
<script >
            document.title='Diccionario de Lenguas Mayas "UtzApp"';
    </script>
	<div class="container">		
		<div style="margin: 0 auto;max-width: 330px;padding: 15px; text-align: center; ">
			<legend>Diccionario de Lenguas Mayas <h2>"UtzApp"</h2></legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
					
		</div>
		<h1>Diccionario: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>ESPAÑOL</th>
					      <th>PALABRA</th>
					      <th>LENGUA</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php foreach ($diccionario as $key => $value):?>
						<tr>
							<td><?php echo $value['espanol']; ?></td>
							<td><?php echo $value['palabra']; ?></td>
							<td><?php echo $value['lengua']; ?></td>	
						</tr>
					  <?php endforeach; ?>
					</tbody>
	</div>
	
</body>
</html>