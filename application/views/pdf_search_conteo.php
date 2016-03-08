<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">DETALLE PARA CONTEO FISICO</h3>
<div>
	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
</div>
<div class="panel panel-default">
	<table class="table table-condensed table-bordered texto_tablas">
	<thead>
		<tr>
			<th>Codigo&nbsp;</th>
			<th>Almacen&nbsp;</th>
			<th>Descripcion</th>
			<th>Procedencia&nbsp;</th>
			<th>Unidad&nbsp;</th>
			<!-- <th>Empaque</th> -->
			<th>Saldo&nbsp;</th>
			<th>Verificacion&nbsp;</th>
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
		<!-- <td class="centrar_texto"><?= $key->empaque; ?></td> -->
		<td class="cantidad_texto"><?= ($key->saldo == 0 ? '-':number_format($key->saldo,0,".", ",")); ?></td>
		<td class="centrar_texto">_______</td>
	</tr>
	<?php } ?>
	</tbody>
</table>