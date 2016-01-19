<!-- ***************************************** -->
<div class="row-fluid alinear_vertical2">
	<div class="span12">

				<!--button class="btn btn-primary" id="imprimir-busqueda">Imprimir Busqueda</button-->
				
				<div class="buscador_conteo">
				<div style="float:left;">
					<h3>CONTEO FISICO</h3>
				</div>
				<div style="float:right; margin-top: 2%; WIDTH: 25%; margin-right: 5%;">
					<!--div style="float:left;">
						<input type="text" id="buscar_para_conteo" name="buscar_para_conteo" class="form-group icono input" placeholder="Buscar" autofocus >
					</div-->
					<form id="frm_pdf_main_search_conteo" name="frm_pdf_main_search_conteo" action="to_pdf_search_conteo" target="_blank" method="post">
						
						<input type="text" id="buscar_para_conteo" name="buscar_para_conteo" class="form-group icono input" placeholder="Buscar" autofocus >
						<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda-conteo" class="imagen printer">
						<!--img src="../assets/images/lupa.png" alt="Buscar" class="imagen"-->
						
					</form>
					</div>
				</div>
		<!-- <div class="table-responsive"> -->
		<table id="tabla_conteo" class="table table-bordered table-striped table-hover table-condensed">
			<thead class="bg-info">
			<tr>
				<th>#</th>
				<th>Codigo Articulo</th>
				<th>Descripción</th>
				<th>Unidad</th>
				<th>Empaque</th>
				<th>Procedencia</th>
				<!-- <th>Fecha</th> -->
				<th>Existencia</th>
				<th>Verificacion</th>
				<!-- <th>saldo</th> -->
				
			</tr>
			</thead>
			<?php
				$i = 0;
				foreach ($conteo as $key) {
					$i++;
			?>
			<tr id="<?= $key->id_articulo; ?>">
				<td><?= $i; ?></td>
				<td class="centrar"><?= $key->cod_articulo; ?></td>
				
				<td><?= $key->descripcion; ?></td>
				
				<td class="centrar"><?= $key->unidad; ?></td>
				<td class="centrar"><?= $key->empaque; ?></td>
				<td class="centrar"><?= $key->procedencia; ?></td>
				<!-- <td><?= $key->fecha; ?></td> -->
		
				<td class="cantidad_texto"><?= number_format($key->saldo,0,".",","); ?></td>
				 <td class="centrar">_______</td>
			</tr>
			<?php
				}
			?>
		</table>
		<!-- </div> -->
	</div>
</div>

