<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">DETALLE DE EXISTENCIAS</h3>
<div>
	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
</div>
<div class="panel panel-default">
	<table class="table table-condensed table-bordered texto_tablas">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Almacen</th>
			<th>Descripcion</th>
			<th>Procedencia</th>
			<th>Unidad</th>
			<!-- <th>Empaque</th> -->
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($datos_main_search as $key) {
		
	?>
	<tr>
		<td class="centrar_texto"><?= $key->cod_articulo; ?></td>
		<td class="centrar_texto"><?= $key->cod_almacen; ?></td>
		<td><?= $key->descripcion; ?></td>
		<td class="centrar_texto"><?= $key->procedencia; ?></td>
		<td class="centrar_texto"><?= $key->unidad; ?></td>
		<!-- <td class="centrar"><?= $key->empaque; ?></td> -->
		<td class="cantidad_texto"><?= ($key->saldo == 0 ? '-': number_format($key->saldo,0,".",",")); ?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>