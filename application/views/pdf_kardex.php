<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">KARDEX</h3>
<div>
	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
	<?php
		foreach ($data_articulo as $key) {
	?>
		<small>Codigo del Articulo: <?= $key->cod_articulo; ?></small><br>
		<small>Descripcion: </small><strong> <?= $key->descripcion; ?></strong><br>
		<small>Inventario Inicial: <?= $key->inventario_inicial; ?></small><br>
	<?php } ?>
</div>
<div class="panel panel-default">
	<table class="table table-condensed table-bordered texto_tablas">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Mov.</th>
			<th>Nota</th>
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
		<?php $date=date_create($key->fecha);?>
		<td class="centrar_texto"><?= date_format($date,"d/m/Y"); ?></td>
		<td class="centrar_texto"><?= $key->tipo_movimiento; ?></td>
		<td class="centrar_texto"><?= $key->numero_nota; ?></td>

		<td class="cantidad_texto"><?= ($key->entradas == 0 ? '-':number_format($key->entradas,0,".",",")); ?></td>
		<td class="cantidad_texto"><?= ($key->salidas == 0 ? '-': number_format($key->salidas,0,".",",")); ?></td>
		<td class="cantidad_texto"><?= ($key->saldo == 0 ? '-': number_format($key->saldo,0,".",",")); ?></td>
		
	</tr>
	<?php } ?>
	</tbody>
</table>