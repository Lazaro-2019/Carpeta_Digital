
<?php 

	include('../sesiones/verificar_sesion.php');

	$tUsuario=$_SESSION["user_tipo"];

	if ($tUsuario!='Visualizador') 
	{
		// $col="col-xs-12 col-sm-9 col-md-10 col-lg-10";
?>
		<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2">
			<?php 
				if ($tUsuario=='Administrador') 
				{
			?>
					<div class="sidebar fondo borde fuenteAzul sombra vertical" >
						<h2 class="fondo"><?php echo $tUsuario; ?></h2>
						<ul class="menuv">
							<li class="list-unstyled icoMedia">
								<a href="../inicio/index.php" class="activo"><i class="fas fa-home"></i> <label class="modulo">Inicio</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mPersonas/index.php"><i class="fas fa-users"></i> <label class="modulo">Personas</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mUsuarios/index.php"><i class="fas fa-user"></i> <label class="modulo">Usuarios</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mCategorias/index.php"><i class="fas fa-th-list"></i> <label class="modulo">Categorías</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mPreguntas/index.php"><i class="far fa-question-circle"></i> <label class="modulo">Preguntas</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mArchivos/index.php"><i class="fas fa-archive"></i> <label class="modulo">Archivos</label></a>
							</li>
							<li class="list-unstyled icoMedia modulo">
								<a href="#" onclick="salir();"><i class="fas fa-sign-out-alt"></i> <label class="modulo">Salir</label></a>
							</li>
						</ul>
					</div>				
			<?php 
				}
				else
				{
			?>
					<div class="sidebar fondo borde fuenteAzul sombra vertical" >
						<h2 class="fondo"><?php echo $tUsuario; ?></h2>
						<ul class="menuv">
							<li class="list-unstyled icoMedia">
								<a href="../inicio/index.php" class="activo"><i class="fas fa-home"></i> <label class="modulo">Inicio</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mCategorias/index.php"><i class="fas fa-th-list"></i> <label class="modulo">Categorías</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mPreguntas/index.php"><i class="far fa-question-circle"></i> <label class="modulo">Preguntas</label></a>
							</li>
							<li class="list-unstyled icoMedia">
								<a href="../mArchivos/index.php"><i class="fas fa-archive"></i> <label class="modulo">Archivos</label></a>
							</li>
							<li class="list-unstyled icoMedia modulo">
								<a href="#" onclick="salir();"><i class="fas fa-sign-out-alt"></i> <label class="modulo">Salir</label></a>
							</li>
						</ul>
					</div>				
			<?php 
				}
			$col="col-xs-12 col-sm-9 col-md-10 col-lg-10";
			?>
		</div>
<?php 
	}
	else
	{
			?>
		<div class="col-xs-0 col-sm-0 col-md-0 col-lg-0">
			<?php 
				$col="col-xs-12 col-sm-12 col-md-12 col-lg-12";
			?>
		</div>
		<?php 
	}
?>
