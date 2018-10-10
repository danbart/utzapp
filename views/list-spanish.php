<?php require 'header.html'; ?>
<script >
            document.title='Listado de palabras en Español';
    </script>
       <style>
/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #fff;
    background-color: #ECF0F1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    color: #18bc9c;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none; */
.tabcontent {
    display: none;
}
</style>
	<div class="container">		
		<div style="margin: 0 auto;max-width: 330px;padding: 15px; text-align: center; ">
			<legend>Listado de palabras en Español</legend>
			<?php if(isset($flash['errors'])): ?>
				<p class="text-error"><?php echo $flash['errors']?></p>
			<?php endif; ?>
						
		</div>
		<h1>Listado: </h1>
		<table class="table table-striped table-hover ">
					  <thead>
					    <tr class="active">
					      <th>ID</th>
					      <th>PALABRA</th>
					      <!--th>DESCRIPCION</th-->
					      <?php if($validarAdmin){?>
					      <th>EDITAR</th>
					      <?php }?>
					    </tr>
					  </thead>
					  <?php $cont=1;?>
						<?php $tempcont =0;
						$temp1cont=1;
						echo '<tbody id="'.$temp1cont.'" class="tabcontent" style="display: table-row-group;">';
						foreach ($listspanish as $key => $value):
							$tempcont++; 
							if($tempcont==50){ 
								$temp1cont++;
								echo '</tbody>';
								echo '<tbody id="'.$temp1cont.'" class="tabcontent"i>';
								$tempcont=0; } 
								?>
						<tr>
							<td><?php echo $cont;?></td>
							<td><?php echo $value['utz_palabra']; ?></td>
							<!--td--><?php //echo $value['utz_descripcion']; ?><!--/td-->
							<?php if($validarAdmin){?>
							<td><a href="./editar/<?php echo $value['utz_idPalabra']; ?>/palabraspanol" >editar</a></td>
							<?php }?>
						</tr>
						<?php $cont+=1;?>
					 <?php 
					  endforeach; ?>
					  	</tbody>
					  	</table>
					  	<ul class="pagination pagination-sm">
					  	<?php
					  	for($i = 1; $i <= $temp1cont; $i++){
					  		echo '<li><a class="tablinks" onclick="changeTabWiev(event, \''.$i.'\')">'.$i.'</a></li>';
					  	};  ?>
					  </ul>

	<script>
function changeTabWiev(evt, contNum) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(contNum).style.display = "table-row-group";
    evt.currentTarget.className += " active";
}
</script>
</head>
</body>
</html>