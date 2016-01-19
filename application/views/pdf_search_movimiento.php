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
	<table class="table table-condensed texto_tablas">
	<thead>
		<tr>
			<th>#</th>
			<th>Codigo Articulo</th>
			<th>Descripción</th>
			<th>Unidad</th>
			<th>Empaque</th>
			<th>Procedencia</th>
			<th>Inv. Inicial</th>
			<th>Entradas</th>
			<th>Salidas</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($datos_main_search as $key) {
		
	?>
	<tr>
		<td><?= $key->cod_articulo; ?></td>
		<td><?= $key->descripcion; ?></td>
		<td class="centrar"><?= $key->unidad; ?></td>
		<td class="centrar"><?= $key->empaque; ?></td>
		<td class="centrar"><?= $key->procedencia; ?></td>
		<td class="cantidad_texto"><?= number_format($key->inv_inicial,0,".",","); ?></td>
		<td class="cantidad_texto"><?= number_format($key->entradas,0,".",","); ?></td>
		<td class="cantidad_texto"><?= number_format($key->salidas,0,".",","); ?></td>
		<td class="cantidad_texto"><?= number_format($key->saldo,0,".",","); ?></td>
		
	</tr>
	<?php } ?>
	</tbody>
</table>