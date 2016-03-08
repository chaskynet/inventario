<!-- ***************************************** -->
<div class="row-fluid alinear_vertical2">
	<div class="span12">

				<!--button class="btn btn-primary" id="imprimir-busqueda">Imprimir Busqueda</button-->
				
				<div class="buscador_conteo">
				<div style="float:left;">
					<h3>EXISTENCIAS</h3>
				</div>

				<!-- <div class="col-xs-3">
					<input type="checkbox">Almacen</input>
				</div> -->

				<div style="float:right; margin-top: 2%; WIDTH: 25%; margin-right: 5%;">
					<!--div style="float:left;">
						<input type="text" id="buscar_para_conteo" name="buscar_para_conteo" class="form-group icono input" placeholder="Buscar" autofocus >
					</div-->
					<form id="frm_pdf_main_search" name="frm_pdf_main_search" action="to_pdf_main_search" target="_blank" method="post">
						
						<input type="text" id="buscar" name="buscar" class="form-group icono input" placeholder="Buscar" autofocus >
						<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda" class="imagen printer">
						<!--img src="../assets/images/lupa.png" alt="Buscar" class="imagen"-->
						
					</form>
					</div>
				</div>
		
		<table id="tabla_existencias" class="table table-condensed table-striped resaltado cabecera">
			<thead class="bg-info">
			<tr>
				<th>#</th>
				<th>Codigo</th>
				<th>Almacen</th>
				<th>Descripción</th>
				<th>Procedencia</th>
				<th>Unidad</th>
				<th>Empaque</th>
				<th>Existencia</th>
			</tr>

			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($existencias as $key) {
					$i++;
				?>
				<tr>
					<td><?= $i; ?></td>
					<td class="centrar_texto"><?= $key->cod_articulo; ?></td>
					<td class="centrar_texto"><?= $key->cod_almacen; ?></td>
					<td><?= $key->descripcion; ?></td>
					<td class="centrar_texto"><?= $key->procedencia; ?></td>
					<td class="centrar_texto"><?= $key->unidad; ?></td>
					<td class="centrar_texto"><?= $key->empaque; ?></td>
					<td class="cantidad_texto"><?= ($key->saldo == 0 ? '-': number_format($key->saldo,0,".",",")); ?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>