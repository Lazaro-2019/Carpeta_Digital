<?php 
	include('../sesiones/verificar_sesion.php');
?>
<div class="sidebar fondo borde fuenteAzul sombra vertical" >
	<h2 class="fondo">Personas</h2>
	<ul class="menuv">
		<li class="list-unstyled icoMedia">
			<a href="" id="mnuA" class="menuInicio">
				<i class="fas fa-certificate"></i>
				<label class="modulo">Catálogo</label> 
			</a>
		</li>
		<li class="list-unstyled icoMedia">
			<a href="#" onclick="imprimir();" id="mnuB" class="menuInicio">
				<i class="far fa-file-pdf"></i>
				<label class="modulo">Reportes</label>  
			</a>
		</li>
		<li class="list-unstyled icoMedia" class="menuInicio">
			<a href="../inicio/index.php" id="mnuC">
				<i class="fas fa-home"></i>
				<label class="modulo">Inicio</label>  
			</a>
		</li>
		<li class="list-unstyled icoMedia">
			<a href="#" onclick="salir();"><i class="fas fa-sign-out-alt"></i>
			<label class="modulo">Salir</label> </a>
		</li>
	</ul>
</div>