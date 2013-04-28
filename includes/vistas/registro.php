<?php
	require_once "includes/config.php";
	require_once "includes/helpers.php";
	render('_header',array('title'=>"Registro de usuario"))
?>
	<script src="assets/js/tienda.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.mobile.datebox.min.css">
	<script type='text/javascript' src="assets/js/datebox.js"></script>
	<script type='text/javascript'>//<![CDATA[ 
		$(window).load(function(){
			$('#fnacimiento').live('click', function() {
				$('#fnacimiento').datebox('open');
			});
		});//]]>  
	</script>
<form action="#" data-ajax="false" method="post" >
	<label for="doc">Documento Identidad</label>
	<input name="doc" id="doc" placeholder="" value="" type="text" required/>

	<label for="nombre">Nombres</label>
	<input name="nombre" id="nombre" placeholder="" value="" type="text" required/>
	
	<label for="apellido">Apellidos</label>
	<input name="apellido" id="apellido" placeholder="" value="" type="text" required/>

	<label for="direccion">Direccion</label>
	<input name="direccion" id="direccion" placeholder="" value="" type="text" required/>
	
	<label for="telefono">Telefono</label>
	<input name="telefono" id="telefono" placeholder="" value="" type="number" />
	
	<label for="email">Email</label>
	<input name="email" id="email" placeholder="" value="" type="email" required />

	<label for="genero">Genero</label>
	<select id="genero" name="genero" data-native-menu="false" data-theme="b" data-mini="true" >
	<option value="femenino">Femenino</option>
	<option value="masculino">Masculino</option>
	</select>	
	<select name="tipo" id="tipo"  data-native-menu="false" data-theme="b" data-mini="true" >
            <option value="Administrador">Administrador</option>
            <option value="Docente">Docente</option>
        </select>
        <label for="fnacimiento">Fecha de Nacimiento</label>
	<input name="fnacimiento" data-role="datebox" id="fnacimiento" data-options='{"noButton": true}' placeholder="" value="" type="date" data-mini="true" required/>
	<br/>
	<label for="nick">Nick</label>
	<input name="nick" id="nick" placeholder="" value="" type="text" required />

	<label for="clave">Clave</label>
	<input name="clave" id="" placeholder="" value="" type="password" required/>

	<label for="rclave">Repetir Clave</label>
	<input name="rclave" id="" placeholder="" value="" type="password" required/>

	<input data-theme="b" data-icon="forward" data-iconpos="left" value="Registrar" data-mini="true" type="submit" name="registrar"/>
   </form>
<?php 
render('_footer');
?>
