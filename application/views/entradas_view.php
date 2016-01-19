<!-- Ventana para busqueda de articulos-->
<div id="modal_añadir_articulos" class="modal fade" role="dialog">
  <div class="modal-dialog caja">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="col-xs-10 input-group">
			  <span class="input-group-addon">Articulo a buscar: </span>
			  <input type="text" class="form-control" id="articulo_buscar" autofocus>
			</div>
      </div>
      <div class="modal-body ventana_modal" id="modal_content_busqueda">
      	
        <table class="table" id="tabla_articulos">
			<thead>
			<tr>
				<th>Cod. Articulo</th>
				<th>Descripción</th>
				<th>Procedencia</th>
				<th>Saldo</th>
			</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cargar">Cargar Articulos</button>
      </div>
    </div>

  </div>
</div>
<!-- Fin ventana Busqueda de Articulos -->
<div class="list-articulos">
	<h2>&nbsp;</h2>
	<div class="">

		<div class="row">
			<div class="col-xs-2">
				
				<div id="combo_nota_entrada" style="float:left;margin-top:2%;">
					<strong><span class="etiqueta">ENTRADA  </span></strong>
					<select id="num_nota_entrada">
						<option value=""></option>
						<?php
							foreach ($notas_entrada as $key) {
						?>
						<option value="<?= $key->numero_nota; ?>"><?= $key->numero_nota; ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="nueva-salida">Nuevo</button> -->
				<p title="Generar Nueva Nota de Salida" style="padding-top:5%;">
					<!-- <img src="../assets/images/plus.png" id="nueva-salida"> -->
					&nbsp;
				</p>
			</div>

			<div class="col-xs-1">
				<div class=""  id="cabecera_salida">
				<form action="to_pdf_nota_entrada" target="_blank" method="post" id="frm_pdf_entradas" name="frm_pdf_entradas">
					<input type="hidden" id="h_nota_entrada" name="h_nota_entrada">
				</form>
				<p title="Añadir Articulos a la Nota de Entrada">
					<img src="../assets/images/lupa.png" id="agregar-articulos" data-toggle="modal" data-target="#modal_añadir_articulos" alt="Agregar Articulos">
				</p>
				</div>
			</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="nueva-salida">Nuevo</button> -->
				<p title="Generar Nueva Nota de Entrada" style="padding-top:5%;">
					<!-- <img src="../assets/images/plus.png" id="nueva-entrada"> -->
					<a href="" id="nueva-entrada"><span>Nuevo</span></a>
				</p>
				</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="guardar-salida">Guardar</button> -->
				<p title="Guardar Nota de Entrada" style="padding-top:5%;">
					<!-- <img src="../assets/images/save.png" id="guardar-entrada"> -->
					<a href="" id="guardar-entrada"><span>Guardar</span></a>
				</p>
				</div>
			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="imprimir-salida">Imprimir</button> -->
				<p title="Imprimir Nota de Entrada" style="padding-top:5%;">
					<!-- <img src="../assets/images/printer.png" id="imprimir-entrada"> -->
					<a href="" id="imprimir-entrada"><span>Imprimir</span></a>
				</p>
			</div>

			<div class="col-xs-1">
				<div class="" id="cabecera_salida2">
				<?php if(in_array('chk_edit_nota', $this->session->userdata('permisos'))){ ?>
					<div class="btn-editar">
						<!-- <button class="btn btn-primary" id="editar-cantidades">Editar Cantidades</button> -->
						<p title="Editar Cantidades de la Nota de Entrada" style="padding-top:10%;">
							<!-- <img src="../assets/images/edit.png" id="editar-cantidades"> -->
							<a href="" id="editar-cantidades"><span>Editar</span></a>
						</p>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="col-xs-4 cantidad_texto">
				<p>
				<!-- <div style="float: left;"> -->
					 <span id="vendedor"><strong>Usuario:&nbsp;</strong> <?= $this->session->userdata('usuario'); ?></span>&nbsp;&nbsp;
				<!-- </div> -->
					 <strong>Fecha: &nbsp;</strong><span id="fecha_creacion"><?= date('d-m-Y'); ?></span>
				</p>
			</div>
		</div>

		
		<div>
			<table class="table" id="tabla_salidas">
				<thead class="bg-info">
					<tr>
						<th>Acciones</th>
						<th>Codigo Item</th>
						<th>Descripcion</th>
						<th>Procedencia</th>
						<th>Unidad</th>
						<th>Empaque</th>
						<th>Cantidad</th>
					</tr>	
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>



