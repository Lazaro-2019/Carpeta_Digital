<?php 
function userA($tipo){
	if ($tipo!='Administrador') {
		 ?>
		<script>
			window.location="../inicio/index.php"
		</script>
		<?php 
	}
 
}

function userE($tipo){
	if ($tipo!='Administrador') {
		if ($tipo!='Encargado') {
			?>
			<script>
				window.location="../inicio/index.php"
			</script>
			<?php 
		}
	}
}


function categoUsuarios($area){
	if ($tipo!='Administrador') {
		 ?>
		<script>
			window.location="../inicio/index.php"
		</script>
		<?php 
	}
 
}
 ?>