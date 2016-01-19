<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
</head>
<body>
<h3 class="centrar">NOTA DE SALIDA</h3>
<div>
	<small>Número de Nota:<?= $num_nota_salida; ?></small><br>

	<small>Usuario: <?= $usuario; ?></small><br>

	<small>Fecha: <?= $fecha; ?></small><br>
</div>
<div class="panel panel-default">
	<table class="table table-condensed texto_tablas">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Procedencia</th>
				<th>Unidad</th>
				<th>Empaque</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($datos_nota_salida as $key) {
			
		?>
		<tr>
			<td><?= $key->cod_articulo; ?></td>
			<td><?= $key->descripcion; ?></td>
			<td><?= $key->procedencia; ?></td>
			<td><?= $key->unidad; ?></td>
			<td><?= $key->empaque; ?></td>
			<td class="cantidad_texto"><?= number_format($key->cantidad,0,".", ","); ?></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
</body>