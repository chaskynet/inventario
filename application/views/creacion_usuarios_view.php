<!-- Ventana Modal de Resumen de Movimiento de Articulos-->
	<div id="modal_edita_usuario" class="modal fade" role="dialog">
	  <div class="modal-dialog caja_usr">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar datos del usuario: </h4>
	      </div>
	      <div class="modal-body well" id="modal_content_usuario">
	      		<input type="hidden" id="id_usuario">
	      		<div class="row">
					<div class="form-group col-xs-5">
						<label for="usuario">Usuario:
							<input type="text" id="ed_usuario" class="form-control col-lg-1">
						</label>
						<label for="nombre">Nombre:
							<input type="text" id="ed_nombre" class="form-control col-lg-1">
						</label>
					</div>
					<div class="form-group col-xs-5">
						<div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_inv_ini" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="Inventario Inicial" value="Inventario Inicial" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_exist">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Existencias" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_nota_ingre" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Ingreso de Productos" disabled>
					    </div>

					</div>
				</div>

				<div class="row">
					<div class="form-group col-xs-5">
						<label for="ed_apaterno">Apellido Paterno: 
							<input type="text" id="ed_apaterno" class="form-control col-lg-1">
						</label>
						<label for="amaterno">Apellido Materno: 
							<input type="text" id="ed_amaterno" class="form-control col-lg-1">
						</label>	
					</div>
					<div class="form-group col-xs-5">
						<div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_nota_salida" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Salida de Productos" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_edit_nota">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Editar Notas" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_lst_conteo" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Lista Conteo Fisico" disabled>
					    </div>
					    
					</div>
				</div>

				<div class="row">
					<div class="form-group col-xs-5">
						<label for="ci">C.I.: 
							<input type="text" id="ed_ci" class="form-control">
						</label>
						<!-- <label for="password">Password: 
							<input type="password" id="ed_password" class="form-control">
						</label> -->
					</div>
					<div class="form-group col-xs-5">
						<div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_mov_inventa" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Mov. de Inventario" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_modifica">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Modificaciones" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_config">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Configuraciones" disabled>
					    </div>
					    
					</div>
				</div>

				<!-- <div class="row">
				<div class="form-group col-xs-3">
					<input type="radio" name="ed_rol" value="0"/> Administrador
					<input type="radio" name="ed_rol" value="1"/> Usuario
				</div>
				</div> -->
				<input type="submit" value="Actualizar Usuario" id="actualizar_usuario" class="btn btn-primary">
	      </div>
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>

	  </div>
	</div>

<!-- ***************************************** -->
<!-- Ventana Modal de Creacion de nuevos Usuarios-->
<div id="modal_creacion_usuarios" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Creación de nuevo Usuario</h4>
      </div>
      <div class="modal-body well" id="modal_content_resumen">
       		<?php echo form_open('');?>
       			<div class="row">
       				<div class="col-xs-5">
						<div class="form-group"><?php echo validation_errors();?></div>
						<div>
							<label for="usuario">Usuario: </label>
							<input type="text" id="usuario" class="form-control">
						</div>
						<div>
							<label for="nombre">Nombre: </label>
							<input type="text" id="nombre" class="form-control">
						</div>
						<div>
							<label for="apaterno">Apellido Paterno: </label>
							<input type="text" id="apaterno" class="form-control">
						</div>
						<div>
							<label for="amaterno">Apellido Materno: </label>
							<input type="text" id="amaterno" class="form-control">
						</div>
						<div>
							<label for="ci">C.I.: </label>
							<input type="text" id="ci" class="form-control">
						</div>
						<div>
							<label for="password">Password: </label>
							<input type="password" id="password" class="form-control">
						</div>
						<!-- <div class="input-group input-group-sm">
							<label for="rol">Rol: </label>
							<input type="radio" name="rol" value="0"/> Administrador
							<input type="radio" name="rol" value="1"/> Usuario
						</div> -->
						<div class="boton_crear">
							<input type="submit" value="Crear Usuario" id="crear_usuario" class="btn btn-primary">
						</div>
					</div>
					<div class="col-xs-5 para_check_new">
						<div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_inv_ini">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Inventario Inicial" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_exist">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Existencias" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_nota_ingre">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Ingreso de Productos" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_nota_salida">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Salida de Productos" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_edit_nota">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Editar Notas" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_lst_conteo">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Lista Conteo Fisico" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_mov_inventa">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Mov. de Inventario" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_modifica">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Modificaciones" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_config">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Configuraciones" disabled>
					    </div>
					</div>
				</div>
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
		<h2>Lista de usuarios</h2>
		<button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_creacion_usuarios">Nuevo Usuario</button>
		<table class="table table-bordered table-striped table-hover table-condensed">
			<tr>
				<th>#</th>
				<th>Usuario</th>
				<th>Nombre Completo</th>
				<th>C.I.</th>
				<th>Estado</th>
				<!-- <th>Rol</th> -->
			</tr>
			<?php
				$i = 0;
				foreach ($usuarios as $key) {
					$i++;
			?>
			<tr id="<?= $key->id_usuario; ?>">
				<td><?= $i; ?></td>
				<td><?= $key->uname; ?></td>
				<td><a href="#" data-toggle="modal" data-target="#modal_edita_usuario" id="nombre_usuario"><?= $key->nombre.' '.$key->apaterno.' '.$key->amaterno; ?></a></td>
				<td class="centrar"><?= $key->ci; ?></td>
				<td class="centrar"><?= $key->estado ? 'Activo' : 'Desactivado'; ?></td>
				<!-- <td class="centrar"><?= $key->rol ? 'Usuario' : 'Administrador'; ?></td> -->
			</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>


