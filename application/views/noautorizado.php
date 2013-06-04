<h1>No estás autorizado para acceder a la página</h1>
<p>La página <?php echo anchor(current_url())?> que solicitas requiere que inicies sesion</p>
<a href="<?php echo site_url('usuario/login')?>" data-role="button" data-icon="check" data-theme="a">Iniciar Sesion</a>
<a href="<?php echo site_url('usuario/registro')?>" data-role="button" data-icon="check" data-theme="a">Registrarme</a>
