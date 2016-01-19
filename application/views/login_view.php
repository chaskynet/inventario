<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login - Inventarios</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h2>Ingrece sus datos</h2>
				<?php echo form_open('main/login_validation');?>
					<div class="form-group"><?php echo validation_errors();?></div>
					<div class="form-group">
						<label for="usuario"></label>
						<input type="text" name="usuario" id="usuario" class="form-control" placeholder="usuario">
					</div>

					<div class="form-group">
						<label for="password"></label>
						<input type="password" name="password" id="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<label for="alamcen"></label>
						<select class="form-control" name="almacen" id="almacen">
							<option></option>
							<?php
								foreach ($almacenes as $key) {
							?>
								<option value="<?= $key->abreviacion; ?>"><?= $key->nombre_almacen; ?></option>
							<?php 
								}
							?>
						</select>
					</div>
					<input type="submit" value="Ingresar" class="btn btn-primary">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</body>
</html>