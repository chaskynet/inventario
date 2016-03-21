<!-- Ventana para Kardex de articulos-->
<div id="modal_kardex_articulos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="height: 90px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div style="float: left;">
        	<h4 class="modal-title">Kardex de Articulos</h4>
        	Descripcion:
        	<label id="descripcion"></label>
        	<br>
        	Inv. Inicial:
        	<label id="invini"></label>
        </div>
        
    	
      </div>
      <div class="modal-body" id="modal_content_busqueda">
      	
        <table class="table cabecera" id="kardex_articulos">
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
				
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
      	<div style="width: 25%;float:left;">
	    	<form id="frm_pdf_kardex" name="frm_pdf_kardex" action="to_pdf_kardex" target="_blank" method="post">
							
				<input type="hidden" id="buscar_para_kardex" name="buscar_para_kardex">
				<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-kardex" class="printer2">
				
			</form>
		</div>
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
			
			<div style="float:right; margin-top: 2%; margin-right: 5%;">
			
				<form id="frm_pdf_main_search_movimiento" name="frm_pdf_main_search_movimiento" action="to_pdf_search_movimiento" target="_blank" method="post">
					
					<input type="text" id="buscar_movimiento" name="buscar_movimiento" class="form-group icono input" placeholder="Buscar" autofocus >
					<select name="buscar_almacen_kardex" id="buscar_almacen_kardex">
						<option value="todo">Todo</option>
						<?php 
							foreach ($almacenes as $key) {
						?>
						<option><?= $key->abreviacion;?></option>
						<?php } ?>
					</select>
					<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda-movimiento" class="imagen printer">
					
				</form>
			</div>
		</div>
		
		<table id="tabla_movimiento" class="table table-striped table-condensed cabecera resaltada">
			<thead>
			<tr>
				<th>#</th>
				<th>Codigo</th>
				<th>Almacen</th>
				<th>Descripción</th>
				<th>Unidad</th>
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
				<td class="centrar_texto"><?= $key->cod_articulo; ?></td>
				<td class="centrar_texto"><?= $key->almacen; ?></td>
				<td><a href="" id="kardex_articulo" data-toggle="modal" data-target="#modal_kardex_articulos"> <?= $key->descripcion; ?></a></td>
				<td class="centrar_texto"><?= $key->unidad; ?></td>
				<!-- <td class="centrar_texto"><?= $key->empaque; ?></td> -->
				<td class="centrar_texto"><?= $key->procedencia; ?></td>
				<td class="cantidad_texto"><?= ($key->inv_inicial == 0 ? '-':number_format($key->inv_inicial,0,".",",")); ?></td>
				<td class="cantidad_texto"><?= ($key->entradas == 0 ? '-':number_format($key->entradas,0,".",",")); ?></td>
				<td class="cantidad_texto"><?= ($key->salidas == 0 ? '-': number_format($key->salidas,0,".",",")); ?></td>
				<td class="cantidad_texto"><?= ($key->saldo == 0 ? '-':number_format($key->saldo,0,".",",")); ?></td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>