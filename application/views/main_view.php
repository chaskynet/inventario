<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
	
	<!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
	<title>Inventario - Main</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<?php
				$permiso = $this->session->userdata('permisos'); //json_decode($this->session->userdata('permisos'));
			?>
			<!-- <a href="#" class="navbar-brand" id="home">Inicio</a> -->
			<a href="#" class="navbar-brand" id="home">Almacen: <?=  $this->session->userdata('almacen'); ?></a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					<!-- <li class="active"><a href="#" id="home">Home</a></li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php if(in_array('chk_inv_ini', $permiso)){ ?>
								<li><a href="#" id="inventario-inicial">Inventario Inicial</a></li>
							<?php } if(in_array('chk_nota_ingre', $permiso)){ ?>
								<li><a href="#" id="ingreso-productos">Ingreso de Productos</a></li>
							<?php } if(in_array('chk_nota_salida', $permiso)){ ?>
								<li><a href="#" id="salida-productos">Salida de Productos</a></li>
							<?php } if(in_array('chk_lst_conteo', $permiso)){ ?>
								<li><a href="#" id="rep-para-conteo">Lista Para conteo fisico</a></li>
							<?php } if(in_array('chk_mov_inventa', $permiso)){ ?>
								<li><a href="#" id="rep-mov-inv">Movimiento de inventarios</a></li>
							<?php }?>
						</ul>
					</li>
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
						<ul class="dropdown-menu">
						</ul>
					</li> -->
					<?php if(in_array('chk_config', $permiso)){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuraciones <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="creacion-usuarios">Creación de usuarios</a></li>
							<li><a href="#" id="creacion-almacenes">Creación de Almacenes</a></li>
						</ul>
					</li>
					<?php 
						}
					?>
					<li><a href="logout">Salir</a></li>
					<li><a href="#">Usuario: <?php echo $this->session->userdata('usuario'); ?></a></li>

				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div id="contenido" class="row">
			<?php if(in_array('chk_nota_salida', $permiso)){ ?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary" id="salida-articulos">Salida de Articulos</button>
			</div>
			<?php } if (in_array('chk_nota_ingre', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary" id="ingreso-articulos">Entrada de Articulos</button>
			</div>
			<?php } if (in_array('chk_exist', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary" id="existencias">Existencias</button>
			</div>
			<?php }?>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/css/bootstrap/js/bootstrap.js"></script>
	<!--script type="text/javascript" src="<?php echo base_url();?>assets/js/number_format.js"></script-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/AjaxFileUploader/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/inventario.js"></script>
</body>
</html>