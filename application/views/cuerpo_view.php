<!-- <div class="well col-sm-4 centrar alinear_vertical">
	<button class="btn btn-primary" id="salida-articulos">Salida de Articulos</button>
</div>
<div class="well col-sm-4 centrar alinear_vertical">
	<button class="btn btn-primary" id="ingreso-articulos">Entrada de Articulos</button>
</div>
<div class="well col-sm-4 centrar alinear_vertical">
	<button class="btn btn-primary" id="existencias">Existencias</button>
</div> -->
<?php
	$permiso = $this->session->userdata('permisos'); //json_decode($this->session->userdata('permisos'));
 	if(in_array('chk_nota_salida', $permiso)){ 
 ?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="salida-articulos">Salida de Articulos</button>
			</div>
			<?php } if (in_array('chk_nota_ingre', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="ingreso-articulos">Entrada de Articulos</button>
			</div>
			<?php } if (in_array('chk_exist', $permiso)) {?>
			<div class="well col-sm-4 centrar alinear_vertical">
				<button class="btn btn-primary color_botones" id="existencias">Existencias</button>
			</div>
			<?php } if (in_array('chk_inv_ini', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="inventario-inicial">Inventario Inicial</button>
			</div>
			<?php } if (in_array('chk_lst_conteo', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="rep-para-conteo">Conteo Fisico</button>
			</div>
			<?php } if (in_array('chk_mov_inventa', $permiso)) {?>
			<div class="well col-sm-4 centrar ">
				<button class="btn btn-primary color_botones" id="rep-mov-inv">Movimiento Inventario</button>
			</div>
<?php }?>
