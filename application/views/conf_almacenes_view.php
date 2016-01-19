<!-- Ventana Modal de Resumen de Movimiento de Articulos-->
<div id="modal_edita_almacen" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Almacen: </h4>
      </div>
      <div class="modal-body well" id="modal_content_almancen">
      		<input type="hidden" id="id_almacen">
			<div class="form-group">
				<label for="usuario">Nombre Almacen: </label>
				<input type="text" id="ed_nombre_almacen">
			</div>
			<div class="form-group">
				<label for="nombre">abreviacion: </label>
				<input type="hidden" id="ed_abreviacion_old">
				<input type="text" id="ed_abreviacion">
			</div>
			
			<input type="submit" value="Actualizar Almacen" id="actualizar_almacen" class="btn btn-primary">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->
<!-- Ventana Modal de Creacion de nuevos Usuarios-->
<div id="modal_creacion_almacen" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Creación de nuevo Almacen</h4>
      </div>
      <div class="modal-body well" id="modal_content_resumen">
       		<?php echo form_open('');?>
				<div class="form-group"><?php echo validation_errors();?></div>
				<div class="form-group">
					<label for="usuario">Nombre Almacen: </label>
					<input type="text" id="nombre_almacen">
				</div>
				<div class="form-group">
					<label for="nombre">abreviacion: </label>
					<input type="text" id="abreviacion">
				</div>
				<input type="submit" value="Crear Almacen" id="crear_almacen" class="btn btn-primary">
			<?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_creacion_usr">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- ***************************************** -->
<div class="row-fluid">
	<div class="span12">
		<h2>Lista de Almacenes Creados</h2>
		<!-- <button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_creacion_almacen">Crear Nuevo Almacen</button> -->
		<!-- <a href="" id="agregar-articulos" data-toggle="modal" data-target="#modal_creacion_almacen">Crear Nuevo Almacen</a> -->
		<button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_creacion_almacen">Crear Nuevo Almacen</button>
		<table class="table table-bordered table-striped table-hover table-condensed">
			<tr>
				<th>#</th>
				<th>Nombre Almacen</th>
				<th>Abreviacion</th>
				<th>Fecha Creacion</th>
			</tr>
			<?php
				$i = 0;
				foreach ($almacenes as $key) {
					$i++;
			?>
			<tr id="<?= $key->id_almacen; ?>">
				<td><?= $i; ?></td>
				<td><a href="#" data-toggle="modal" data-target="#modal_edita_almacen" id="nombre_almacen"><?= $key->nombre_almacen; ?></a></td>
				<td class="centrar"><?= $key->abreviacion; ?></td>
				<td class="centrar"><?= $key->fecha; ?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>


