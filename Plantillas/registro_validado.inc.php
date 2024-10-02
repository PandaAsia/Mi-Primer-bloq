<div class="form-group">
	<label>Nombre de Usuario</label>
	<br>
	<input type="text" name="Nombre" class="form-control" placeholder="Nombre" <?php $validador->mostrar_nombre(); ?>>
	<?php $validador->mostar_error_nombre() ?>
</div>
<div class="form-group">
	<label>Email</label>
	<br>
	<input type="email" name="Email" class="form-control" placeholder="example@gmail.com" <?php $validador->mostrar_email(); ?>>
	<?php $validador->mostar_error_email() ?>
</div>
<div class="form-group">
	<label>Password</label>
	<br>
	<input type="password" name="clave1" class="form-control" placeholder="*********">
	<?php $validador->mostar_error_clave1() ?>
</div>
<div class="form-group">
	<label>Repite Password</label>
	<br>
	<input type="password" name="clave2" class="form-control" placeholder="**********">
	<?php $validador->mostar_error_clave2() ?>
</div>
	<button type="reset" class="btn btn-default btn-primary">Reiniciar</button>
	<br>
	<br>
	<button type="submit" class="btn btn-default btn-primary" name="enviar">Crear Cuenta</button>
