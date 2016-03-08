<div class="list-articulos">
	<h2>&nbsp;</h2>
	<div class="">
		<div class="row">
			<div class="col-xs-2">
				
				<div id="combo_nota_salida" style="float:left;margin-top:2%;">
					<strong><span class="etiqueta">SALIDA</span>&nbsp;</strong>
					<input type="hidden" id="modo_edicion" value="false" />
					<select id="num_nota_salida">
						<option value=""></option>
						<?php
							foreach ($notas_salida as $key) {
						?>
						<option value="<?= $key->numero_nota; ?>"><?= $key->numero_nota; ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="col-xs-2">
				<div class="" id="cabecera_salida">
					<form action="to_pdf_nota_salida" target="_blank" method="post" id="frm_pdf_salidas" name="frm_pdf_salidas">
						<input type="hidden" id="h_nota_salida" name="h_nota_salida">
					</form>
					<p title="Añadir Articulos a la Nota de Salida" style="float: left;">
						<a href="#" id="agregar-articulos-salida" data-backdrop="false" data-toggle="modal" data-target="#modal_añadir_articulos" class="ocultar">
							+&nbsp;Agregar Articulos
						</a>
					</p>
				</div>
			</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="nueva-salida">Nuevo</button> -->
				<p title="Generar Nueva Nota de Salida">
					<!-- <img src="../assets/images/plus.png" id="nueva-salida"> -->
					<a href="#" id="nueva-salida"><span>Nuevo</span></a>
				</p>
			</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="guardar-salida">Guardar</button> -->
				<p title="Guardar Nota de Salida" >
					<!-- <img src="../assets/images/save.png" id="guardar-salida"> -->
					<a href="" id="guardar-salida"><span>Guardar</span></a>
				</p>
				</div>

			<div class="col-xs-1">
				<!-- <button class="btn btn-primary" id="imprimir-salida">Imprimir</button> -->
				<p title="Imprimir Nota de Salida">
				<!-- <img src="../assets/images/printer.png" id="imprimir-salida"> -->
				<a href="" id="imprimir-salida"><span>Imprimir</span></a>
				</p>
			</div>

			<div class="col-xs-1">
				<div class="" id="cabecera_salida2">
				<?php if(in_array('chk_edit_nota', $this->session->userdata('permisos'))){ ?>
					<div class="btn-editar">
						<!-- <button class="btn btn-primary" id="editar-cantidades">Editar Cantidades</button> -->
						<p title="Editar Cantidades de la Nota de Salida" >
							<!-- <img src="../assets/images/edit.png" id="editar-cantidades" alt="Editar Articulos"> -->
							<a href="" id="editar-cantidades"><span>Editar</span></a>
						</p>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- <div class="col-sm-2">
				<input type="text" id="buscar_para_conteo" name="buscar_para_conteo" class="form-group icono input" placeholder="Buscar" autofocus >
			</div> -->
			<div class="col-xs-4 cantidad_texto">
				<p>
				<!-- <div style="float: left;"> -->
					<span id="vendedor"><strong>Usuario:&nbsp;</strong><?= $this->session->userdata('usuario'); ?></span>&nbsp;&nbsp;
				<!-- </div>	 -->
					<strong>Fecha:</strong>&nbsp;<span id="fecha_creacion"><?= date('d-m-Y'); ?></span>
				</p>
			</div>

		</div>
		
		<div>
			<table class="table table-condensed table-striped resaltado cabecera" id="tabla_salidas">
				<thead class="bg-america">
					<tr>
						<th>Acciones</th>
						<th>Codigo</th>
						<th>Almacen</th>
						<th>Descripcion</th>
						<th>Procedencia</th>
						<th>Unidad</th>
						<!-- <th>Empaque</th> -->
						<th>Cantidad</th>
					</tr>	
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>



