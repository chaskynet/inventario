<!-- Ventana para Kardex de articulos-->
<div id="modal_kardex_articulos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div style="float: left;">
        	<h4 class="modal-title">Kardex de Articulos</h4>
        </div>
    	<div>
	    	<form id="frm_pdf_kardex" name="frm_pdf_kardex" action="to_pdf_kardex" target="_blank" method="post">
							
				<input type="hidden" id="buscar_para_kardex" name="buscar_para_kardex">
				<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-kardex" class="printer2">
				
			</form>
		</div>
      </div>
      <div class="modal-body" id="modal_content_busqueda">
      	
        <table class="table" id="kardex_articulos">
			<thead class="bg-info">
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
				
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Fin ventana Busqueda de Articulos --><!-- ***************************************** -->
<div class="row-fluid alinear_vertical2">
	<div class="span12">

		<!--button class="btn btn-primary" id="imprimir-busqueda">Imprimir Busqueda</button-->
		
		<div class="buscador_conteo">
		<div style="float:left;">
			<h3>MOVIMIENTO DE INVENTARIOS</h3>
		</div>
			<div style="float:right; margin-top: 2%; WIDTH: 25%; margin-right: 5%;">
			
				<form id="frm_pdf_main_search_movimiento" name="frm_pdf_main_search_movimiento" action="to_pdf_search_movimiento" target="_blank" method="post">
					
					<input type="text" id="buscar_movimiento" name="buscar_movimiento" class="form-group icono input" placeholder="Buscar" autofocus >
					<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda-movimiento" class="imagen printer">
					
				</form>
			</div>
		</div>
		
		<table id="tabla_movimiento" class="table table-bordered table-striped table-hover table-condensed">
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
				$i = 0;
				foreach ($movimiento as $key) {
					$i++;
			?>
			<tr id="<?= $key->cod_articulo; ?>">
				<td><?= $i; ?></td>
				<td class="centrar"><?= $key->cod_articulo; ?></td>
				<td><a href="" id="kardex_articulo" data-toggle="modal" data-target="#modal_kardex_articulos"> <?= $key->descripcion; ?></a></td>
				<td class="centrar"><?= $key->unidad; ?></td>
				<td class="centrar"><?= $key->empaque; ?></td>
				<td class="centrar"><?= $key->procedencia; ?></td>
				<td class="cantidad_texto"><?= number_format($key->inv_inicial,0,".",","); ?></td>
				<td class="cantidad_texto"><?= number_format($key->entradas,0,".",","); ?></td>
				<td class="cantidad_texto"><?= number_format($key->salidas,0,".",","); ?></td>
				<td class="cantidad_texto"><?= number_format($key->saldo,0,".",","); ?></td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>