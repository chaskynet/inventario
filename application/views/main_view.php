<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
	
	<!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
	<title>Inventario - Main</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">
</head>
<body>

	<!-- Ventana para busqueda de articulos-->
		<div id="modal_añadir_articulos" class="modal fade" >
		  <div class="modal-dialog caja">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <div class="col-xs-10 input-group">
					  <span class="input-group-addon"><strong>Articulo a buscar: </strong> </span>
					  <input type="text" class="form-control" id="articulo_buscar" autofocus>
					</div>
		      </div>
		      <div class="modal-body ventana_modal" id="modal_content_busqueda">
		      	
		        <table class="table table-hover" id="tabla_articulos">
					<thead>
					<tr>
						<th>Cod. Articulo</th>
						<th>Descripción</th>
						<th>Procedencia</th>
						<th>Saldo</th>
					</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
		      </div>
		      <div class="modal-footer">
		      	<button id="cargar" class="btn btn-primary flotar-izquierda">Cargar Articulos</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- Fin ventana Busqueda de Articulos -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<?php
				$permiso = $this->session->userdata('permisos'); //json_decode($this->session->userdata('permisos'));
			?>
			<!-- <a href="#" class="navbar-brand" id="home">Inicio</a> -->
			<a href="#" class="navbar-brand" id="home">Almacenes</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php if(in_array('chk_inv_ini', $permiso)){ ?>
								<li><a href="#" id="inventario-inicial">Inventario Inicial</a></li>
							<?php } if(in_array('chk_exist', $permiso)){ ?>
								<li><a href="#" id="existencias">Existencias</a></li>
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
	<!-- -->
	<div class="side-menu ocultar" id="sideMenu">
	    <menu>
	        <ul class="nav nav-tabs nav-stacked">
	            <li><a href="#myModal" data-backdrop="false" data-toggle="modal">Click Me</a>
	            </li>
	        </ul>
	    </menu>
	</div>
	<div id="myModal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                 <h4 class="modal-title">Settings-main</h4>

	            </div>
	            <div class="modal-body">
	                <p>Settings</p>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-primary">Save changes</button>
	            </div>
	        </div>
	        <!-- /.modal-content -->
	    </div>
	    <!-- /.modal-dialog -->
	</div>
<!-- /.modal -->
		<div id="contenido" class="row">
			<?php if(in_array('chk_nota_salida', $permiso)){ ?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="salida-articulos">Salida de Articulos</button>
			</div>
			<?php } if (in_array('chk_nota_ingre', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="ingreso-articulos">Entrada de Articulos</button>
			</div>
			<?php } if (in_array('chk_exist', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="existencias">Existencias</button>
			</div>
			<?php } if (in_array('chk_inv_ini', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="inventario-inicial">Inventario Inicial</button>
			</div>
			<?php } if (in_array('chk_lst_conteo', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="rep-para-conteo">Conteo Fisico</button>
			</div>
			<?php } if (in_array('chk_mov_inventa', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="rep-mov-inv">Movimiento Inventario</button>
			</div>
			<?php }?>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/css/bootstrap/js/bootstrap.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/AjaxFileUploader/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/stickyheader.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/inventario.js"></script>
</body>
</html>