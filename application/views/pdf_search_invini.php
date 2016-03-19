<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">INVENTARIO INICIAL</h3>
<div>
	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
</div>
<div class="panel panel-default">
	<table class="table table-condensed table-bordered texto_tablas">
	<thead>
		<tr>
			<th>#</th>
			<th>Cod Articulo</th>
			<th>Almacen</th>
			<th>Descripción</th>
			<th>Unidad</th>
			<th>Empaque</th>
			<th>Procedencia</th>
			<th>Cant. Crítica</th>
			<th>Inv. Inicial</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i = 1;
		foreach ($datos_main_search as $key) {
	?>
	<tr>
		<td><?= $i; ?></td>
		<td class="centrar_texto"><?= $key->cod_articulo; ?></td>
		<td class="centrar_texto"><?= $key->cod_almacen; ?></td>
		<td><?= $key->descripcion; ?></td>
		
		<td class="centrar_texto"><?= $key->unidad; ?></td>
		<td class="centrar_texto"><?= $key->empaque; ?></td>
		<td class="centrar_texto"><?= $key->procedencia; ?></td>

		<td class="cantidad_texto"><?= ($key->cantidad_critica == 0 ? '-':number_format($key->cantidad_critica,0,".", ",")); ?></td>
		<td class="cantidad_texto"><?= ($key->inventario_inicial == 0 ? '-': number_format($key->inventario_inicial,0,".", ",")); ?></td>
	</tr>
	<?php $i++; } ?>
	</tbody>
</table>