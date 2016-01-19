<!-- Ventana Modal de Resumen de Movimiento de Articulos-->
<div id="modal_resumen_movimientos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edición de Articulos: </h4>
      </div>
      <div class="modal-body" id="modal_content_resumen">
      	<div class="modal-body well" id="modal_content_almancen">
      		<input type="hidden" id="id_articulo">
			<div class="form-group">
				<label for="ed_cod_articulo">Codigo de Articulo: </label>
				<input type="text" id="ed_cod_articulo">
			</div>
			<div class="form-group">
				<label for="ed_descripcion">Descripción: </label>
				<input type="text" id="ed_descripcion">
			</div>
			<div class="form-group">
				<label for="ed_unidad">Unidad: </label>
				<input type="text" id="ed_unidad">
			</div>
			<div class="form-group">
				<label for="ed_empaque">Empaque: </label>
				<input type="text" id="ed_empaque">
			</div>
			<div class="form-group">
				<label for="ed_procedencia">Procedencia: </label>
				<input type="text" id="ed_procedencia">
			</div>
			<div class="form-group">
				<label for="ed_cant_critica">Cantidad Crítica: </label>
				<input type="text" id="ed_cant_critica">
			</div>
			<div class="form-group">
				<label for="ed_inv_inicial">Inventario Inicial: </label>
				<input type="text" id="ed_inv_inicial">
			</div>

			<input type="submit" value="Actualizar Articulo" id="actualizar_articulo" class="btn btn-primary">
      	</div>  
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->

<!-- Ventana Modal Nuevo Articulo-->
<div id="modal_nuevo_articulo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Articulo </h4>
      </div>
      <div class="modal-body" id="modal_content_resumen">
      	<div class="modal-body well" id="modal_content_almancen">
      		<!-- <input type="hidden" id="id_articulo"> -->
			<div class="form-group">
				<label for="cod_articulo">Codigo de Articulo: </label>
				<input type="text" id="cod_articulo" class="form-control uppercase">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción: </label>
				<input type="text" id="descripcion" class="form-control">
			</div>
			<div class="form-group">
				<label for="unidad">Unidad: </label>
				<input type="text" id="unidad" class="form-control">
			</div>
			<div class="form-group">
				<label for="empaque">Empaque: </label>
				<input type="text" id="empaque" class="form-control">
			</div>
			<div class="form-group">
				<label for="procedencia">Procedencia: </label>
				<input type="text" id="procedencia" class="form-control">
			</div>
			<div class="form-group">
				<label for="cant_critica">Cantidad Crítica: </label>
				<input type="text" id="cant_critica">
			</div>
			<div class="form-group">
				<label for="inv_inicial">Inventario Inicial: </label>
				<input type="text" id="inv_inicial">
			</div>
			<!-- <div class="form-group">
				<label for="saldo">Saldo: </label>
				<input type="text" id="ed_saldo">
			</div> -->

			<input type="submit" value="Crear Articulo" id="crear_articulo" class="btn btn-primary">
      	</div>  
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->

<!-- Ventana Modal de Importacion de Articulos desde archivo Excel-->
<div id="modal_importa_articulos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Importar Articulos desde Excel</h4>
      </div>
      <div class="modal-body" id="modal_content_resumen">
       		<?php echo form_open_multipart('');?>
					<div class=""><?php echo validation_errors();?></div>
					<div class="form-group">
						
						<input type="file" name="archivo" id="archivo" class="form-control" placeholder="Seleccione archivo a importar">
					</div>
					<input type="submit" value="Subir Archivo" id="upload_file" class="btn btn-primary">
			<?php echo form_close(); ?>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_upload">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->

<!-- Ventana Modal de Articulos Repetidos-->
<div id="modal_articulos_repetidos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Articulos Repetidos</h4>
      </div>
      <div class="modal-body ventana_modal" id="modal_content_repetidos">
       		<table class="table" id="tabla_repetidos">
			<thead>
			<tr>
				<th>Cod. Articulo</th>
				<th>Descripción</th>
			</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_upload">Cerrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_actualiza_repetidos">Actualizar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->
<div class="row-fluid">
	<h2>&nbsp;</h2>
	<div class="span12">
			<?php if(in_array('chk_modifica', $this->session->userdata('permisos'))){ ?>
			<!-- <h3>Inventario</h3> -->
			<!-- <button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_importa_articulos" style="margin-right:5%;">Importar Artículos</button> -->
			<a href="" id="agregar-articulos" data-toggle="modal" data-target="#modal_importa_articulos" style="margin-right:10%;">Importar Artículos</a>
			<a href="" id="nuevo-articulo" data-toggle="modal" data-target="#modal_nuevo_articulo" style="margin-right:10%;">Nuevo Artículo</a>
			<a href="<?= base_url(); ?>assets/files/template.xls">Descargar Plantilla</a>
			<?php } ?>
		<div style="float:right; margin-top: 0%; WIDTH: 25%; margin-right: 5%;">
			
			<form id="frm_pdf_main_search_invini" name="frm_pdf_main_search_invini" action="to_pdf_search_invini" target="_blank" method="post">
				
				<input type="text" id="buscar_invini" name="buscar_invini" class="form-group icono input" placeholder="Buscar" autofocus >
				<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda-invini" class="imagen printer">
				
			</form>
		</div>
		<table id="tabla_invini" class="table table-bordered table-striped table-hover table-condensed">
			<thead class="bg-info">
				<tr>
					<th>#</th>
					<th>Codigo Articulo</th>
					<th>Descripción</th>
					<th>Unidad</th>
					<th>Empaque</th>
					<th>Procedencia</th>
					<!-- <th>Fecha</th> -->
					<th>Cant. Crítica</th>
					<th>Inv. Inicial</th>
					<!-- <th>saldo</th> -->
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 0;
				foreach ($articulo as $key) {
					$i++;
			?>
				<tr id="<?= $key->id_articulo; ?>">
					<td><?= $i; ?></td>
					<td class="centrar"><?= $key->cod_articulo; ?></td>
					<?php if(in_array('chk_modifica', $this->session->userdata('permisos'))){ ?>
					<td><a href="#" data-toggle="modal" data-target="#modal_resumen_movimientos" id="articulo"><?= $key->descripcion; ?></a></td>
					<?php
						} else{
					?>
						<td><?= $key->descripcion; ?></td>
					<?php
						}
					?>
					<td class="centrar"><?= $key->unidad; ?></td>
					<td class="centrar"><?= $key->empaque; ?></td>
					<td class="centrar"><?= $key->procedencia; ?></td>
					<!-- <td><?= $key->fecha; ?></td> -->
					<td class="cantidad_texto"><?= $key->cantidad_critica; ?></td>
					<td class="cantidad_texto"><?= $key->inventario_inicial; ?></td>
					<!-- <td class="cantidad_texto"><?= $key->saldo; ?></td> -->
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</div>
