<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">MOVIMIENTO DE INVENTARIO</h3>
<div>
	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
</div>
<div class="panel panel-default">
	<table class="table table-condensed table-bordered texto_tablas">
	<thead>
		<tr>
			<th>#</th>
			<th>Codigo</th>
			<th>Almacen</th>
			<th>Descripción</th>
			<th>Unidad</th>
			
			<th>Procedencia</th>
			<th>Inv. Inicial</th>
			<th>E.</th>
			<th>S.</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i = 1;
		foreach ($datos_main_search as $key) {
	?>
	<tr>
		<td><?=$i;?></td>
		<td class="centrar_texto"><?= $key->cod_articulo; ?></td>
		<td class="centrar_texto"><?= $key->almacen; ?></td>
		<td><?= $key->descripcion; ?></td>
		<td><?= $key->unidad; ?></td>
		
		<td><?= $key->procedencia; ?></td>
		<td class="cantidad_texto"><?= ($key->inv_inicial == 0 ? '-': number_format($key->inv_inicial,0,".",",")); ?></td>
		<td class="cantidad_texto"><?= ($key->entradas == 0 ? '-': number_format($key->entradas,0,".",",")); ?></td>
		<td class="cantidad_texto"><?= ($key->salidas == 0 ? '-': number_format($key->salidas,0,".",",")); ?></td>
		<td class="cantidad_texto"><?= number_format($key->saldo,0,".",","); ?></td>
		
	</tr>
	<?php $i++; } ?>
	</tbody>
</table>